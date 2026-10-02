@extends('backend.layouts.app')
@section('page-styles')
@endsection
@section('content')
  <x-breadcrumb :pageTitle="$pageTitle" :skipLevels="$cmsPage->id ? [1] : []" />
  <x-form-card :formTitle="$cardHeader" :backRoute="route('admin.cms-pages')" :formId="'cmsPagesForm'">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Title</label>
          <input class="form-control only-alphabet-symbols" type="text" name="cms_title" id="cms_title"
            placeholder="Enter Title" value="{{ $cmsPage->title ?? '' }}">
          <div id="cms_title-error-container"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 required">
          <label class="form-label">Slug</label>
          <input class="form-control lowercase-slug" type="text" name="cms_slug" id="cms_slug"
            placeholder="Enter Slug" value="{{ $cmsPage->slug ?? '' }}">
          <div id="cms_slug-error-container"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-3 not-required">
          <label class="form-label">Meta Title</label>
          <input class="form-control" type="text" name="meta_title" id="meta_title" placeholder="Enter Title"
            value="{{ $cmsPage->meta_title ?? '' }}">
          <div id="meta_title-error-container"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3 not-required">
          <label class="form-label">Meta Keywords</label>
          <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" placeholder="Enter Keywords"
            value="{{ $cmsPage->meta_keywords ?? '' }}">
          <div id="meta_keywords-error-container"></div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="mb-3 required">
          <label class="form-label">Status</label>
          <select class="form-select" name="cms_status" id="cms_status">
            <option value="1" {{ $cmsPage->status === 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $cmsPage->status === 0 ? 'selected' : '' }}>Inactive</option>
          </select>
          <div id="status-error-container"></div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="mb-3 not-required">
          <label class="form-label">Meta Description</label>
          <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter Meta Description">{{ $cmsPage->meta_description ?? '' }}</textarea>
          <div id="meta_description-error-container"></div>
        </div>
      </div>
      @php
        $existingSections = [];
        if (!empty($cmsPage->body)) {
          $decoded = json_decode($cmsPage->body, true);
          if (is_array($decoded) && count($decoded) > 0) {
            foreach ($decoded as $decSec) {
              if (!empty(strip_tags(trim($decSec['description'] ?? ''))) || !empty($decSec['image'])) {
                $existingSections[] = $decSec;
              }
            }
          }
        }
        if (empty($existingSections)) {
          $existingSections[] = [
            'description' => $cmsPage->body ?? '',
            'image' => $cmsPage->feature_image ?? '',
          ];
        }
      @endphp

      <!-- Banner Image for About Us -->
      <div class="col-md-6 about-us-fields" style="{{ ($cmsPage->slug ?? '') == 'about-us' ? '' : 'display: none;' }}">
        <div class="mb-3 not-required">
          <label class="form-label fw-semibold">Hero Banner Image</label>
          <input class="form-control" type="file" name="banner_image" id="banner_image" accept="image/*">
          <div id="banner_image-error-container" class="error"></div>
        </div>
      </div>
      <div class="col-md-6 about-us-fields" id="banner_preview_container" style="{{ ($cmsPage->slug ?? '') == 'about-us' && isset($cmsPage->banner_image) ? '' : 'display:none' }}">
        <div class="mb-3 not-required">
          <img
            src="{{ isset($cmsPage->banner_image) ? asset('/public/uploads/cms_pages/' . $cmsPage->banner_image) : '' }}"
            class="img-thumbnail mt-3" id="banner_preview" style="max-height:100px;">
        </div>
      </div>

      <!-- Dynamic Sections for About Us -->
      <div class="col-md-12 about-us-fields" id="about_us_sections_area" style="{{ ($cmsPage->slug ?? '') == 'about-us' ? '' : 'display: none;' }}">
        <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light border rounded">
          <div>
            <label class="form-label fw-bold mb-0 text-dark">About Us Content Sections</label>
            <span class="text-muted d-block small">Add multiple description and image sections for the About Us page</span>
          </div>
          <button type="button" class="btn btn-primary btn-sm" id="add_section_btn">
            <i class="fa fa-plus me-1"></i> + Add Description & Image Section
          </button>
        </div>
        <div id="dynamic_sections_container"></div>
      </div>

      <!-- Standard Description & Image for other CMS pages -->
      <div class="col-md-12 standard-cms-fields" style="{{ ($cmsPage->slug ?? '') == 'about-us' ? 'display: none;' : '' }}">
        <div class="mb-3 not-required">
          <label class="form-label">Description</label>
          <div id="cms_description" name="cms_description"></div>
          <div id="cms_description-error-container"></div>
        </div>
      </div>
      <div class="col-md-6 standard-cms-fields" style="{{ ($cmsPage->slug ?? '') == 'about-us' ? 'display: none;' : '' }}">
        <div class="mb-3 not-required">
          <label class="form-label">Image</label>
          <input class="form-control" type="file" name="cms_image" id="cms_image" accept="image/*">
          <span class="text-muted">Preferred Size: 1360 x 500 px (Allowed Extensions: JPG, PNG, GIF & WebP)</span>
          <div id="cms_image-error-container" class="error"></div>
        </div>
      </div>

      <div class="col-md-6 standard-cms-fields" id="image_preview_container" style="{{ ($cmsPage->slug ?? '') != 'about-us' && !empty($cmsPage->feature_image) ? '' : 'display:none;' }}">
        <div class="mb-3 not-required">
          <img
            src="{{ $cmsPage->feature_image ? asset('/public/uploads/cms_pages/' . $cmsPage->feature_image) : '' }}"
            class="img-thumbnail mt-3" id="image_preview" style="max-height:100px;">
        </div>
      </div>
    </div>
  </x-form-card>
@endsection
@section('page-scripts')
  <script src="{{ asset('/public/backend/assetss/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('/public/backend/assetss/js/ckeditor5.js') }}"></script>
  <script src="{{ asset('/public/common/js/custom_input.js?v=1' . time()) }}"></script>
  <script>
    let ckeditor5Instances = {};

    // Standard CKEditor for non-about-us pages
    const stdElement = document.getElementById('cms_description');
    if (stdElement) {
      ClassicEditor.create(stdElement, {
        toolbar: [
          'heading', '|',
          'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
          'blockQuote', 'insertTable', 'undo', 'redo', '|',
          'sourceEditing'
        ],
        htmlSupport: {
          allow: [{
            name: /.*/,
            attributes: true,
            classes: true,
            styles: true
          }]
        }
      }).then(editor => {
        ckeditor5Instances['cms_description'] = editor;
        editor.ui.view.editable.element.style.height = '300px';
        const existingContent = @json($cmsPage->body ?? '');
        if ($('#cms_slug').val() !== 'about-us') {
          editor.setData(existingContent);
        }
      }).catch(error => {
        console.error('CKEditor initialization error:', error);
      });
    }

    // Dynamic Sections for About Us
    const existingAboutSections = @json($existingSections ?? []);
    let sectionCounter = 0;

    function initSectionEditor(index, initialContent = '') {
      const el = document.getElementById(`section_desc_${index}`);
      if (!el) return;

      ClassicEditor.create(el, {
        toolbar: [
          'heading', '|',
          'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
          'blockQuote', 'insertTable', 'undo', 'redo', '|',
          'sourceEditing'
        ],
        htmlSupport: {
          allow: [{
            name: /.*/,
            attributes: true,
            classes: true,
            styles: true
          }]
        }
      }).then(editor => {
        ckeditor5Instances[`section_desc_${index}`] = editor;
        editor.ui.view.editable.element.style.height = '200px';
        if (initialContent) {
          editor.setData(initialContent);
        }
      }).catch(error => {
        console.error('CKEditor init error on section ' + index, error);
      });
    }

    function addSection(data = {}) {
      const idx = sectionCounter++;
      const desc = data.description || '';
      const img = data.image || '';
      const imgUrl = img ? `{{ asset('/public/uploads/cms_pages/') }}/${img}` : '';

      const html = `
        <div class="card mb-3 border shadow-sm section-card" id="section_card_${idx}" data-index="${idx}">
          <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
            <strong class="section-title text-primary"><i class="fa fa-layer-group me-1"></i> Section #${$('.section-card').length + 1}</strong>
            <button type="button" class="btn btn-outline-danger btn-sm delete-section-btn" data-index="${idx}">
              <i class="fa fa-trash me-1"></i> Delete Section
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold">Description</label>
                <div id="section_desc_${idx}"></div>
              </div>
              <div class="col-md-6 mb-2">
                <label class="form-label fw-semibold">Section Image</label>
                <input class="form-control section-image-input" type="file" name="about_sections[${idx}][image]" id="section_image_${idx}" accept="image/*" data-index="${idx}">
                <input type="hidden" name="about_sections[${idx}][old_image]" id="section_old_image_${idx}" value="${img}">
                <span class="text-muted small">Allowed: JPG, PNG, GIF, WebP (Max: 2MB)</span>
                <div id="section_image_${idx}-error-container" class="error text-danger small"></div>
              </div>
              <div class="col-md-6 mb-2" id="section_preview_container_${idx}" style="${img ? '' : 'display:none;'}">
                <label class="form-label fw-semibold d-block">Current / Preview Image</label>
                <img src="${imgUrl}" class="img-thumbnail" id="section_preview_${idx}" style="max-height: 100px;">
              </div>
            </div>
          </div>
        </div>
      `;

      $('#dynamic_sections_container').append(html);
      initSectionEditor(idx, desc);
    }

    // Initialize about us sections on load
    if (existingAboutSections && existingAboutSections.length > 0) {
      existingAboutSections.forEach(sec => addSection(sec));
    } else {
      addSection(); // Always show at least 1 section by default
    }

    // Add section button click
    $('#add_section_btn').on('click', function() {
      addSection();
    });

    // Delete section button click
    $(document).on('click', '.delete-section-btn', function() {
      if ($('.section-card').length <= 1) {
        if (typeof swalNotify === 'function') {
          swalNotify("Warning!", "At least one description and image section is required.", "warning");
        } else {
          alert("At least one description and image section is required.");
        }
        return;
      }
      const idx = $(this).data('index');
      if (ckeditor5Instances[`section_desc_${idx}`]) {
        ckeditor5Instances[`section_desc_${idx}`].destroy().catch(e => console.log(e));
        delete ckeditor5Instances[`section_desc_${idx}`];
      }
      $(`#section_card_${idx}`).remove();

      // Re-number section titles
      $('.section-card').each(function(i) {
        $(this).find('.section-title').html(`<i class="fa fa-layer-group me-1"></i> Section #${i + 1}`);
      });
    });

    // Section image preview handler
    $(document).on('change', '.section-image-input', function() {
      const idx = $(this).data('index');
      const file = this.files[0];
      if (!file) return;

      const { type, size } = file;
      if (!['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(type)) {
        $(this).val('');
        $(`#section_image_${idx}-error-container`).text('Invalid image type. Only JPEG, PNG, GIF, WebP allowed.');
        return;
      }
      if (size > 2e+6) {
        $(this).val('');
        $(`#section_image_${idx}-error-container`).text('Image size should not exceed 2MB.');
        return;
      }

      $(`#section_image_${idx}-error-container`).text('');
      const reader = new FileReader();
      $(`#section_preview_container_${idx}`).show();
      reader.onload = (e) => {
        $(`#section_preview_${idx}`).attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
    });

    let formID = '{{ Hashids::encode($cmsPage->id ?? '') }}';
    $('#cmsPagesForm').validate({
      rules: {
        cms_title: {
          required: true,
          maxlength: 100
        },
        cms_slug: {
          required: true,
          maxlength: 100
        },
        meta_title: {
          maxlength: 255
        },
        meta_keywords: {
          maxlength: 255
        },
        meta_description: {
          maxlength: 1000
        },
        cms_status: {
          required: true,
        },
      },
      messages: {
        cms_title: {
          required: "{{ __('validation.required', ['attribute' => 'Title']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Title', 'max' => '100']) }}"
        },
        cms_slug: {
          required: "{{ __('validation.required', ['attribute' => 'Slug']) }}",
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Slug', 'max' => '100']) }}"
        },
        meta_title: {
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Meta Title', 'max' => '255']) }}"
        },
        meta_keywords: {
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Meta Keywords', 'max' => '255']) }}"
        },
        meta_description: {
          maxlength: "{{ __('validation.maxlength', ['attribute' => 'Meta Description', 'max' => '1000']) }}"
        },
        cms_status: {
          required: "{{ __('validation.required', ['attribute' => 'Status']) }}",
        },
      },
      errorElement: "div",
      errorPlacement: function(error, element) {
        let errorContainer = $(`#${element.attr('id')}-error-container`);
        if (errorContainer.length) {
          error.appendTo(errorContainer);
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element) {
        $(element).removeClass("is-invalid").addClass("is-valid");
      },
      submitHandler: function(form) {
        let url = "{{ route('admin.cms-pages.store') }}";
        if (formID)
          url = `{{ route('admin.cms-pages.update', ':id') }}`.replace(':id', formID);

        let formData = new FormData(form);
        const isAboutUs = $('#cms_slug').val() === 'about-us';

        if (isAboutUs) {
          let sIndex = 0;
          $('.section-card').each(function() {
            const cardIdx = $(this).data('index');
            const editorKey = `section_desc_${cardIdx}`;
            const descData = ckeditor5Instances[editorKey] ? ckeditor5Instances[editorKey].getData() : '';
            const oldImg = $(`#section_old_image_${cardIdx}`).val() || '';
            const fileInput = document.getElementById(`section_image_${cardIdx}`);
            const hasNewFile = fileInput && fileInput.files && fileInput.files[0];
            const hasText = descData.replace(/<[^>]*>/g, '').trim().length > 0;

            if (hasText) {
              formData.append(`about_sections[${sIndex}][description]`, descData);
              formData.append(`about_sections[${sIndex}][old_image]`, oldImg);

              if (hasNewFile) {
                formData.append(`about_sections[${sIndex}][image]`, fileInput.files[0]);
              }
              sIndex++;
            }
          });
        } else {
          if (ckeditor5Instances['cms_description']) {
            formData.append('cms_description', ckeditor5Instances['cms_description'].getData());
          }
        }

        $.ajax({
          type: "POST",
          url: url,
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response.success) {
              $('.is-valid').removeClass('is-valid');
              swalNotify("Success!", response.message, "success");
              if (!formID) {
                $('#cmsPagesForm')[0].reset();
                if (ckeditor5Instances['cms_description']) {
                  ckeditor5Instances['cms_description'].setData('');
                }
                $('#image_preview_container').hide();
                $('#banner_preview_container').hide();
              }
            } else {
              swalNotify("Oops!", response.message, "error");
            }
          },
          error: function(error) {
            swalNotify("Error!", error.responseJSON ? error.responseJSON.message : "Something went wrong", "error");
          }
        });
      }
    });

    $('#cms_image').change(function() {
      const file = this.files[0];
      const {
        type,
        size
      } = file;

      if (!['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(type)) {
        $(this).val('');
        $('#cms_image-error-container').text(
          'Invalid image type. Only JPEG, PNG, GIF, and WebP images are allowed.');
        return;
      }

      if (size > 2e+6) {
        $(this).val('');
        $('#cms_image-error-container').text('Image size should not exceed 2MB.');
        return;
      }
      $('#cms_image-error-container').text('');
      const reader = new FileReader();
      $('#image_preview_container').show();
      reader.onload = () => $('#image_preview').attr('src', reader.result);
      reader.readAsDataURL(file);
    });

    $('#cms_title').on('input', function() {
      if (formID) return;
      var slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-');
      $('#cms_slug').val(slug).trigger('change');
    });

    $('#cms_slug').on('change input', function() {
      if ($(this).val() === 'about-us') {
        $('.about-us-fields').show();
        $('.standard-cms-fields').hide();
      } else {
        $('.about-us-fields').hide();
        $('.standard-cms-fields').show();
      }
    });

    $('#banner_image').change(function() {
      const file = this.files[0];
      if (!file) return;
      const { type, size } = file;

      if (!['image/jpeg', 'image/png', 'image/gif', 'image/webp'].includes(type)) {
        $(this).val('');
        $('#banner_image-error-container').text('Invalid image type.');
        return;
      }
      if (size > 2e+6) {
        $(this).val('');
        $('#banner_image-error-container').text('Image size should not exceed 2MB.');
        return;
      }
      $('#banner_image-error-container').text('');
      const reader = new FileReader();
      $('#banner_preview_container').show();
      reader.onload = () => $('#banner_preview').attr('src', reader.result);
      reader.readAsDataURL(file);
    });
  </script>
@endsection
