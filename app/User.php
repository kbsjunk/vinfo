<?php

namespace Vinfo;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'country_id', 'language_id', 'currency_id', 'is_admin'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function country()
    {
        return $this->belongsTo('Vinfo\Country');
    }

    public function language()
    {
        return $this->belongsTo('Vinfo\Language');
    }

    public function currency()
    {
        return $this->belongsTo('Vinfo\Currency');
    }

    public function getLanguageCodeAttribute()
    {
        return @$this->language->code ?: 'en';
    }

    public function getCountryCodeAttribute()
    {
        return @$this->country->code ?: 'GB';
    }

    public function getCurrencyCodeAttribute()
    {
        return @$this->currency->code ?: 'GBP';
    }
}
