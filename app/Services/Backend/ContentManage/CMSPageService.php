<?php

namespace App\Services\Backend\ContentManage;

use App\Models\CmsPage;
use App\Services\Backend\BaseFormService;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Storage;

class CMSPageService extends BaseFormService
{
  public function __construct(protected ImageUploadService $imageUploadService)
  {
    parent::__construct(CmsPage::class, 'CMS Page', 'cmsPage');
  }

  public function getCreateData(): array
  {
    return [
      ...$this->getBaseCreateData(),
    ];
  }

  public function getEditData($id = 0)
  {
    return [
      ...$this->getBaseEditData($id),
    ];
  }

  public function storeData($request)
  {
    $this->handleSectionsAndImages($request);
    $this->handleImageUpload($request);
    return CmsPage::store($request);
  }

  public function updateData($request, int $id)
  {
    $cmsPage = CmsPage::findOrFail($id);
    $this->handleSectionsAndImages($request);
    $this->handleImageUpload($request, $cmsPage->feature_image ?? null, $cmsPage->banner_image ?? null);
    return CmsPage::store($request, $id);
  }

  protected function handleSectionsAndImages($request): void
  {
    if ($request->cms_slug === 'about-us' && $request->has('about_sections')) {
      $sections = $request->input('about_sections', []);
      $files = $request->file('about_sections', []);
      $processedSections = [];

      foreach ($sections as $index => $sectionData) {
        $desc = $sectionData['description'] ?? '';
        $oldImage = $sectionData['old_image'] ?? null;
        $imageName = $oldImage;

        if (isset($files[$index]['image']) && $files[$index]['image'] instanceof \Illuminate\Http\UploadedFile) {
          $upload = $this->imageUploadService->uploadImage(
            $files[$index]['image'],
            'cms_pages',
            '',
            true
          );
          if (!empty($upload['filename'])) {
            $imageName = $upload['filename'];
          }
        }

        $desc = preg_replace('/background-color:\s*(rgb\(\s*246\s*,\s*243\s*,\s*241\s*\)|#f6f3f1);?/i', '', $desc);
        $desc = preg_replace('/background:\s*(rgb\(\s*246\s*,\s*243\s*,\s*241\s*\)|#f6f3f1);?/i', '', $desc);

        if (!empty(strip_tags(trim($desc)))) {
          $processedSections[] = [
            'description' => $desc,
            'image' => $imageName,
          ];
        }
      }

      $request->merge([
        'cms_description' => json_encode($processedSections),
      ]);
    }
  }

  protected function handleImageUpload($request, ?string $oldImage = null, ?string $oldBannerImage = null): void
  {
    if ($request->hasFile('cms_image')) {
      if ($oldImage) {
        Storage::disk('public')->delete([
          "uploads/cms_pages/{$oldImage}",
          "uploads/cms_pages/thumbnail/{$oldImage}",
        ]);
      }
      $upload = $this->imageUploadService->uploadImage($request->file('cms_image'), 'cms_pages', '', true);
      if (!empty($upload['filename'])) {
        $request->merge(['image_name' => $upload['filename']]);
      }
    } else if ($oldImage) {
      $request->merge(['image_name' => $oldImage]);
    }

    if ($request->hasFile('banner_image')) {
      if ($oldBannerImage) {
        Storage::disk('public')->delete([
          "uploads/cms_pages/{$oldBannerImage}",
          "uploads/cms_pages/thumbnail/{$oldBannerImage}",
        ]);
      }
      $uploadBanner = $this->imageUploadService->uploadImage($request->file('banner_image'), 'cms_pages', '', true);
      if (!empty($uploadBanner['filename'])) {
        $request->merge(['banner_image_name' => $uploadBanner['filename']]);
      }
    } else if ($oldBannerImage) {
      $request->merge(['banner_image_name' => $oldBannerImage]);
    }
  }
}
