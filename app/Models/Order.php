<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'control_number',
        'state'
    ];

    public function getStateName()
    {
        switch ($this->state) {
            case '1':
                $state = 'Pending';
                break;

            case '2':
                $state = 'In progress';
                break;

            case '3':
                $state = 'Completed';
                break;
        }

        return $state;
    }

    public function stateIsPending()
    {
        return $this->state === 1 ? true : false;
    }

    public function stateIsInProgress()
    {
        return $this->state === 2 ? true : false;
    }

    public function stateIsComplete()
    {
        return $this->state === 3 ? true : false;
    }

    public function nextStateIsValid($nextState)
    {
        if ($this->state == '3'
            || $nextState == '2' && $this->state != '1'
            || $nextState == '3' && $this->state != '2'
            || !in_array($nextState, ['1', '2', '3'])
        ) {
            return false;
        } else {
            return true;
        }
    }

    public function scopeFilterState($query, $state)
    {
        if ($state) {
            return $query->where('state', $state);
        }
    }

    public function scopeFilterControlNumber($query, $controlNumber)
    {
        if ($controlNumber) {
            return $query->where('control_number', $controlNumber);
        }
    }
}
