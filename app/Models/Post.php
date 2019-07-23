<?php

namespace App\Models;

use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description','user_id'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

	/**
	* primary key
	*/
	protected $primaryKey = "id";



  public $timestamps = true;

   /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    

    public function __construct(array $attributes = array()) {
       parent::__construct($attributes);
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
