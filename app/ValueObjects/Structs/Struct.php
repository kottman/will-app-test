<?php

namespace App\ValueObjects\Structs;

use Illuminate\Support\Arr;

class Struct implements StructInterface
{
    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function only(array $attributes): array
    {
        return Arr::only(get_object_vars($this), $attributes);
    }

    public function toArray(): array
    {
        $array = get_object_vars($this);

        foreach ($array as &$item) {
            if ($item instanceof StructInterface) {
                $item = $item->toArray();
            }
        }

        return $array;
    }

    public function fill(array $data): StructInterface
    {
        $available = array_intersect_key(
            $data,
            get_class_vars(get_class($this))
        );

        foreach ($available as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}
