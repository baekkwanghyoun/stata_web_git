<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    public function getEventBrowseAttribute()
    {
        return $this->event();
    }

    public function getEventReadAttribute()
    {
        return $this->event();
    }

    public function event()
    {
        if($this->event == 'created') {
            return '생성';
        }
        else if($this->event == 'updated') {
            return '수정';
        }
        else if($this->event == 'deleted') {
            return '삭제';
        }
        else {
            return $this->event;
        }
    }

    public function getSubjectTypeBrowseAttribute()
    {
        return $this->subject();
    }

    public function getSubjectTypeReadAttribute()
    {
       return $this->subject();
    }

    public function subject()
    {
        if(Str::contains($this->subject_type, 'Setting')) {
            return '코드관리';
        }
        else if(Str::contains($this->subject_type, 'Howto')) {
            return '사용법 및 주의사항';
        }
        else if(Str::contains($this->subject_type, 'User')) {
            return '관리자';
        }
        else if(Str::contains($this->subject_type, 'Role')) {
            return '권한관리';
        }
        else if(Str::contains($this->subject_type, 'AllowIp')) {
            return '허용IP';
        }
        else if(Str::contains($this->subject_type, 'Faq')) {
            return 'Faq내용관리';
        }
        else {
            return $this->subject_type;
        }
    }

}
