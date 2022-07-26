<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

/**
 * Class Department
 *
 * @property $id
 * @property $code
 * @property $isActive
 * @property $image_path
 * @property $icon_path
 * @property $organization_id
 * @property $branch_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Branch $branch
 * @property DepartmentTranslation[] $departmentTranslations
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Department extends Model implements TranslatableContract
{
     
    use Translatable; // 2. To add translation methods
    public $translatedAttributes = ['title', 'locale', 'slug'];
    


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code','isActive','image_path', 'organization_id', 'icon_path','branch_id','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departmentTranslations()
    {
        return $this->hasMany('App\Models\DepartmentTranslation', 'department_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function updatedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('isActive', 1);
    }
    /**
     * This is model Observer which helps to do the same actions automatically when you creating or updating models
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public static function GetData(Request $request)
    {
        $data = [];
        foreach (config('app.locales') as $k => $locale) {
            $type = new self();
            foreach ($type->translatedAttributes as $key => $val) {
                $data[$k][$val] = $request->input($val . '_' . $k);
            }
        }
        $data['organization_id'] = $request->input('organization_id');  

        $data['isActive'] = $request->input('isActive');
        $data['branch_id'] = $request->input('branch_id');
        return $data;
    }
    public static function rules()
    {
        $rules = [
            'organization_id' => 'required',
            'branch_id' => 'required',
        ];
        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }


}
