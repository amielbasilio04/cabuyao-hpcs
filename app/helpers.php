<?php 

use Carbon\Carbon;

if(!function_exists('formatTime'))
{
    function formatTime($time, $opt = "12")
    {
        if($opt == "12") {
            return date('h:iA', strtotime($time));
        }
    }

}

if(!function_exists('isOpen'))
{
    function isOpen($status)
    {
        
        return($status === 0) 
        ? '<span class="badge default_bg2 p-2 text-white" role="button" onclick="bookSchedule($d)">Book now<i class="fas fa-paper-plane ml-2"></i></span>' 
        : '<span class="badge secondary_bg p-2 text-white" >Fully Booked <i class="fas fa-times ml-1"></i> </span>';
    }

}

if(!function_exists('formatDate'))
{
    function formatDate($date, $opt="fulldate")
    {
       if($opt == "fulldate") 
       {
          return  date('F d,Y', strtotime($date));
       }

       if($opt == "dateTimeWithSeconds") {
          return date('Y-m-d h:i:s', strtotime($date));
       }
       
       if($opt == "dateTimeLocal") {
        return date('Y-m-d\TH:i', strtotime($date));
       }
       if($opt == "dateTime") 
       {
          return  date('M d,Y h:iA', strtotime($date));
       }


       if($opt == "time") {
        return date('H:iA', strtotime($date));
       }
    }

}

if(!function_exists('isScheduleDone'))
{
    function isScheduleDone($status)
    {
       if($status === 0) 
       {
          return 'Open';
       } else {
          return 'Closed';
       }
    }

}

if(!function_exists('isTaskDone'))
{
    function isTaskDone($status)
    {
       if($status === 0) 
       {
          return 'Pending';
       } else {
          return 'Done';
       }
    }

}

if(!function_exists('isLikedByAuthUser'))
{
    function isLikedByAuthUser($auth_user, $likers) 
    {
        $post_likers = [];// users who likes the post

        foreach($likers as $liker) {
        $post_likers[] = $liker->user_id; // get user id 
        }

        return  (in_array($auth_user, $post_likers)) ? true : false; // check if the user has already liked the post
    }
}


if(!function_exists('handleNullImage'))
{
    function handleNullImage($img)
    {
        if($img) {
            return $img;
        }

        return '/img/noimg.svg';
    }

}


if(!function_exists('calculateElectiveDeliveryDate'))
{
    function calculateElectiveDeliveryDate($date)
    {
       return Carbon::create($date)->addWeek(39)->format('F d,Y');
    }

}










