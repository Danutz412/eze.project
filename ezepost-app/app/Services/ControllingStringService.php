<?php
namespace App\Services;

class ControllingStringService
{
    /**
     * Generate 20-character controlling string
     * Format: [State][Group][Plan][TeamSize][PackageSize] + padding
     * Example: 11309 = Active(1) Business(1) Premium(3) 1-9Users(0) Unlimited(9)
     */
    public function generate(int $state, int $group, int $plan, int $teamSize, int $packageSize): string
    {
        $code = "{$state}{$group}{$plan}{$teamSize}{$packageSize}";
        return str_pad($code, 20, '0', STR_PAD_RIGHT);
    }

    /**
     * Generate from plan subscription
     */
    public function generateFromPlan($plan, $period = 'monthly'): string
    {
        $state = 1; // Active
        $group = 0; // Individual (0) or Business (1)
        $planCode = $plan->id ?? 0;
        $teamSize = $plan->team_size_code ?? 0;
        $packageSize = $plan->package_size_code ?? 0;

        return $this->generate($state, $group, $planCode, $teamSize, $packageSize);
    }

    /**
     * Lock user account (set state to 0)
     */
    public function lock(string $code): string
    {
        return '0' . substr($code, 1);
    }

    /**
     * Unlock user account (set state to 1)
     */
    public function unlock(string $code): string
    {
        return '1' . substr($code, 1);
    }

    /**
     * Check if account is active
     */
    public function isActive(string $code): bool
    {
        return substr($code, 0, 1) === '1';
    }

    /**
     * Check if account is locked
     */
    public function isLocked(string $code): bool
    {
        return substr($code, 0, 1) === '0';
    }

    /**
     * Parse controlling string
     */
    public function parse(string $code): array
    {
        return [
            'state' => (int)substr($code, 0, 1),
            'group' => (int)substr($code, 1, 1),
            'plan' => (int)substr($code, 2, 1),
            'team_size' => (int)substr($code, 3, 1),
            'package_size' => (int)substr($code, 4, 1),
            'is_active' => $this->isActive($code),
            'is_locked' => $this->isLocked($code),
        ];
    }

    /**
     * Update plan in controlling string
     */
    public function updatePlan(string $code, int $planCode, int $teamSize, int $packageSize): string
    {
        $parsed = $this->parse($code);
        return $this->generate(
            $parsed['state'],
            $parsed['group'],
            $planCode,
            $teamSize,
            $packageSize
        );
    }

    /**
     * Set user as business
     */
    public function setAsBusiness(string $code): string
    {
        return substr($code, 0, 1) . '1' . substr($code, 2);
    }

    /**
     * Set user as individual
     */
    public function setAsIndividual(string $code): string
    {
        return substr($code, 0, 1) . '0' . substr($code, 2);
    }
}
