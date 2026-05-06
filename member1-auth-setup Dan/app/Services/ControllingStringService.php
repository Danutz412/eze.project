<?php
namespace App\Services;

class ControllingStringService
{
    public function generate(int $state, int $group, int $plan, int $users, int $size): string
    {
        return str_pad("{$state}{$group}{$plan}{$users}{$size}", 20, '0');
    }

    public function lock(string $code): string { return '0' . substr($code, 1); }
    public function unlock(string $code): string { return '1' . substr($code, 1); }
}
