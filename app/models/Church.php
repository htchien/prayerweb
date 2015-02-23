<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Church extends \Eloquent {

  use SoftDeletingTrait;

  protected $dates = ['deleted_at'];
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'churches';

  protected $fillable = ['name', 'lat', 'lng', 'qlink', 'cid'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('id', 'cid', 'deleted_at', 'created_at', 'updated_at');


  protected function setPrimaryKey($key)
  {
    $this->primaryKey = $key;
  }

  public function targets()
  {
    $this->setPrimaryKey('uid');
    $relation = $this->belongsToMany('Target', 'user_churches', 'uid', 'cid');
    $this->setPrimaryKey('id');

    return $relation;
  }


  public function newCollection(array $models = array())
  {
      return new Extensions\ChurchCollection($models);
  }


  public function scopeYesterday($query)
  {
    return $query->where('created_at', '>', Carbon::yesterday()->startOfDay())
                 ->where('created_at', '<', Carbon::yesterday()->endOfDay())
                 ->get();
  }

}
