<?php
namespace Scu\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingModel;
use Eloquent;

class Post extends ValidatingModel {

    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Setting attributes that should be converted to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes allowed in Eloquent mass assignment.
     *
     * @var array
     */
    protected $fillable = array( 'slug', 'title', 'content', 'published' );

    /**
     * The attributes guarded in Eloquent mass assignment.
     *
     * @var array
     */
    protected $guarded = array('id', 'owner_id');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    /**
     * Rules for validation
     *
     * @var array
     */
    protected $rules = [
            'owner_id'    => 'required|max:255',
            'slug'     => 'required|max:255',
            'title' => 'required',
            'content' => 'required',
            'published'     => 'required',
            //'username' => 'required|max:24|unique:users',
    ];

    /**
     * Setting up a belongs-to-one relationship with member
     *
     * @return belongsTo
     */
    public function owner()
    {
        return $this->belongsTo('\Scu\Models\Member');
    }

    /**
     * Setting up a one-to-many relationship with Comments
     *
     * @return hasMany
     */
    public function comments()
    {
        return $this->hasMany('\Scu\Models\Comment', 'post_id');
    }

    /**
     * Setting up a belongs-to-one relationship with member
     *
     * @return belongsTo
     */
    public function editor()
    {
        return $this->belongsTo('\Scu\Models\Member');
    }
}
