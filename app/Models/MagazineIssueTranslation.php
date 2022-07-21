<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class MagazineIssueTranslation
 *
 * @property $id
 * @property $locale
 * @property $magazine_issue_id
 * @property $title
 * @property $slug
 * @property $body
 * @property $address
 * @property $description
 * @property $short_description
 * @property $editor_in_chief
 * @property $submission_article
 *
 * @property MagazineIssue $magazineIssue
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MagazineIssueTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'magazine_issue_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','magazine_issue_id','title','slug','body','address','description','short_description','editor_in_chief','submission_article'];

    public $timestamps = false;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function magazineIssue()
    {
        return $this->hasOne('App\Models\MagazineIssue', 'id', 'magazine_issue_id');
    }
    


}
