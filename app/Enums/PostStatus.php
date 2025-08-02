<?php

namespace App\Enums;

enum PostStatus:string
{
    case Publish = "public";
    case Draft = "draft";
}
