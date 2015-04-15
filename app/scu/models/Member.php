<?php
namespace Scu\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingModel;
use Eloquent;

class Member extends ValidatingModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait, SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * Setting attributes that should be converted to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'birthday'];

    /**
     * The attributes allowed in Eloquent mass assignment.
     *
     * @var array
     */
    protected $fillable = array( 'name', 'nickname', 'birthday', 'usauID', 'height', 'weight', 'mobile_phone', 'series_intention', 'personal_strengths', 'personal_weaknesses', 'areas_to_improve', 'playing_history' );

    /**
     * The attributes guarded in Eloquent mass assignment.
     *
     * @var array
     */
    protected $guarded = array('id', 'email', 'password', 'remember_token', 'confirmation_code');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Rules for validation
     *
     * @var array
     */
    protected $rules = [
            'email'    => 'required|max:255|email|unique:members,email',
            'name'     => 'required|max:255',
            'password' => 'required',

            //'title'     => 'required',
            //'username' => 'required|max:24|unique:users',

    ];

    /**
     * Return height as converted string
     *
     * @return string
     */
    public function getHeightString()
    {
        return floor($this->height/12) . "' " . ($this->height%12) . '"';
    }

    /**
     * Setting up a one-to-one relationship with apiKey
     *
     * @return hasOne
     */
    public function apiKey()
    {
        return $this->hasOne('\Chrisbjr\ApiGuard\ApiKey');
    }

    /**
     * Setting up a one-to-many relationship with Presentations
     *
     * @return hasMany
     */
    public function ownedPresentations()
    {
        return $this->hasMany('\Black\Models\Presentation', 'owner_id');
    }

    /**
     * Setting up a many-to-many relationship with Presentations
     *
     * @return BelongsToMany
     */
    public function viewablePresentations()
    {
        return $this->belongsToMany('\Black\Models\Presentation');
    }

    /**
     * Setting up a many-to-many relationship with Presentations
     *
     * @return BelongsToMany
     */
    public function presentations()
    {
        return $this->belongsToMany('\Black\Models\Presentation');
    }

    /**
     * Setting up a many-to-many relationship with Teams
     *
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany('\Black\Models\Team');
    }

    /**
     * Setting up a many-to-many relationship with assets
     *
     * @return BelongsToMany
     */
    public function ownedResources()
    {
        return $this->hasMany('\Black\Models\Resource', 'owner_id');
    }

    /**
     * Setting up a many-to-many relationship with assets
     *
     * @return BelongsToMany
     */
    public function viewableResources()
    {
        return $this->belongsToMany('\Black\Models\Resource');
    }

    /**
     * Setting up a one-to-many relationship with organization
     *
     * @return belongsTo
     */
    public function organization()
    {
        return $this->belongsTo('\Black\Models\Organization');
    }

    /**
     * Get the amount of storage used by owned resources converted from bytes
     *
     * http://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
     *
     * @return String
     */
    public function getStorageUsage() {
        $resources = $this->ownedResources;
        $totalStorageBytes = 0;

        foreach ($resources as $resource) {
            if ($resource->file_type){
                $totalStorageBytes += $resource->file_size;
            }
        }

        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($totalStorageBytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1000));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1000, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }

    /**
     * Get a list of tag names associated with presentations that are viewable by the user
     *
     *
     * @return Array
     */
    public function presentationTags()
    {
        $tags = array();
        $ownedPresentations = $this->ownedPresentations;
        $viewablePresentations = $this->viewablePresentations;

        foreach ($ownedPresentations as $presentation){
            foreach($presentation->tags as $tag){
                $tags[] = $tag->name;
            }
        }

        foreach ($viewablePresentations as $presentation){
            foreach($presentation->tags as $tag){
                $tags[] = $tag->name;
            }
        }

        $uniqueTags = array_unique($tags);

        return $uniqueTags;
        // return $this->hasManyThrough('\Black\Tagging\Tag', '\Black\Models\Presentation', 'owner_id', 'id');
    }

    /**
     * Get a list of tag names associated with resources that are viewable by the user
     *
     *
     * @return Array
     */

    public function resourceTags()
    {
        $tags = array();
        $ownedResources = $this->ownedResources;
        $viewableResources = $this->viewableResources;

        foreach ($ownedResources as $resource){
            foreach($resource->tags as $tag){
                $tags[] = $tag->name;
            }
        }

        foreach ($viewableResources as $resource){
            foreach($resource->tags as $tag){
                $tags[] = $tag->name;
            }
        }

        $uniqueTags = array_unique($tags);

        return $uniqueTags;
    }
}
