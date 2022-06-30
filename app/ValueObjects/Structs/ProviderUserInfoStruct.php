<?php

namespace App\ValueObjects\Structs;

class ProviderUserInfoStruct extends Struct
{
    public string $email;
    public string $name;
    public string $given_name;
    public string $family_name;
    public string $hd;
    public string $locale;
    public string $google_id;
    public string $picture;
}
