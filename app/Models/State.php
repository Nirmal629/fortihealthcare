<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\JsonResponse;
use Vinkla\Hashids\Facades\Hashids;

class State extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name',
    'country_id',
    'status',
    'created_by',
    'updated_by',
  ];

  /**
   * The list of 28 official Indian States.
   */
  public const INDIAN_STATES = [
    'Andhra Pradesh',
    'Arunachal Pradesh',
    'Assam',
    'Bihar',
    'Chhattisgarh',
    'Goa',
    'Gujarat',
    'Haryana',
    'Himachal Pradesh',
    'Jharkhand',
    'Karnataka',
    'Kerala',
    'Madhya Pradesh',
    'Maharashtra',
    'Manipur',
    'Meghalaya',
    'Mizoram',
    'Nagaland',
    'Odisha',
    'Punjab',
    'Rajasthan',
    'Sikkim',
    'Tamil Nadu',
    'Telangana',
    'Tripura',
    'Uttar Pradesh',
    'Uttarakhand',
    'West Bengal',
  ];

  /**
   * Scope / query to retrieve strictly India's 28 states
   */
  public static function getIndianStates($columns = ['*'])
  {
    return self::where(function ($query) {
      $query->where('country_id', 101)
        ->orWhereIn('name', self::INDIAN_STATES);
    })
      ->whereIn('name', self::INDIAN_STATES)
      ->orderBy('name', 'asc')
      ->get($columns);
  }

  /**
   * Relationship: State belongs to a Country
   */
  public function country()
  {
    return $this->belongsTo(Country::class);
  }

  /**
   * Store or update a State record
   */
  public static function store($request, $stateid = null): JsonResponse
  {
    if ($request->country === null)
      $countryid = config('defaults.country_id');
    else
      $countryid = Hashids::decode($request->country)[0];

    $update = self::updateOrCreate(
      ['id' => $stateid],
      [
        'name' => $request->statename,
        'country_id' => $countryid,
        'status' => $request->status,
        'updated_by' => user('admin')->id,
        'created_by' => $stateid ? self::find($stateid)->created_by : user('admin')->id,
      ]
    );

    if ($update)
      return response()->json(['success' => true, 'message' => __('response.success' . ($stateid ? '.update' : '.create'), ['item' => 'State'])]);

    return response()->json(['success' => false, 'message' => __('response.error' . ($stateid ? '.update' : '.create'), ['item' => 'State'])]);
  }

  /**
   * Delete a state (soft delete)
   */
  public static function remove(int $id = 0): JsonResponse
  {
    $state = self::find($id);
    if (!$state) {
      return response()->json([
        'success' => false,
        'message' => __('response.not_found', ['item' => 'State'])
      ]);
    }

    $state->delete();
    $state->deleted_by = auth('admin')->id();
    $state->save();

    return response()->json(['success' => true, 'message' => __('response.success.delete', ['item' => 'State'])]);
  }

  /**
   * Toggle the status of a State
   */
  public static function toggleStatus(int $id = 0): JsonResponse
  {
    $state = self::find($id);
    if (!$state) {
      return response()->json([
        'success' => false,
        'message' => __('response.not_found', ['item' => 'State'])
      ]);
    }

    $state->status = !$state->status;
    $state->updated_by = auth('admin')->id();
    $state->save();

    return response()->json([
      'success' => true,
      'message' => __('response.success.update', ['item' => 'State Status']),
      'newStatus' => $state->status
    ]);
  }

  /**
   * Accessor to get Country details dynamically
   */
  public function getCountryDetailsAttribute(): ?array
  {
    return $this->country ? [
      'id' => $this->country->id,
      'name' => $this->country->name,
      'code' => $this->country->code
    ] : null;
  }

  public static function scopeSearch($query, $search)
  {
    return $query->where('name', 'like', '%' . $search . '%')
      ->orWhereHas('country', function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%');
      })
      ->orWhereHas('country', function ($query) use ($search) {
        $query->where('code', 'like', '%' . $search . '%');
      });
  }

  public function addresses()
  {

    return $this->hasMany(Address::class);
  }
}
