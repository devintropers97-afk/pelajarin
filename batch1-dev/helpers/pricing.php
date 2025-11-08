<?php
/**
 * Pricing Helper Functions
 *
 * Dual pricing system calculations and utilities
 * Handles: Beli Putus (one-time) & Sewa Bulanan (subscription)
 *
 * @package SITUNEO
 * @subpackage Helpers
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

/**
 * Get pricing display for service (dual pricing)
 */
function get_service_pricing($service) {
    $pricing_model = $service['pricing_model'] ?? 'both';
    $one_time = $service['one_time_price'] ?? 0;
    $monthly = $service['monthly_price'] ?? 0;

    $result = [
        'model' => $pricing_model,
        'one_time' => $one_time,
        'monthly' => $monthly,
        'one_time_formatted' => format_rupiah($one_time),
        'monthly_formatted' => format_rupiah($monthly),
        'has_one_time' => in_array($pricing_model, ['both', 'one_time_only']),
        'has_subscription' => in_array($pricing_model, ['both', 'subscription_only']),
    ];

    return $result;
}

/**
 * Display price badge (auto-detect best option)
 */
function price_badge($service, $type = 'both') {
    $pricing = get_service_pricing($service);

    if ($type === 'one_time' && $pricing['has_one_time']) {
        return '<span class="price-badge primary">' . $pricing['one_time_formatted'] . '</span>';
    }

    if ($type === 'subscription' && $pricing['has_subscription']) {
        return '<span class="price-badge secondary">' . $pricing['monthly_formatted'] . '/bulan</span>';
    }

    // Both or auto
    if ($pricing['has_one_time'] && $pricing['has_subscription']) {
        return '<span class="price-badge primary">' . $pricing['one_time_formatted'] . '</span>
                <span class="text-muted">atau</span>
                <span class="price-badge secondary">' . $pricing['monthly_formatted'] . '/bulan</span>';
    }

    if ($pricing['has_one_time']) {
        return '<span class="price-badge primary">' . $pricing['one_time_formatted'] . '</span>';
    }

    if ($pricing['has_subscription']) {
        return '<span class="price-badge secondary">' . $pricing['monthly_formatted'] . '/bulan</span>';
    }

    return '<span class="text-muted">Hubungi Kami</span>';
}

/**
 * Calculate savings (berapa hemat jika beli putus vs sewa 12 bulan)
 */
function calculate_savings($one_time_price, $monthly_price, $months = 12) {
    $total_subscription = $monthly_price * $months;
    $savings = $total_subscription - $one_time_price;
    $percentage = ($savings / $total_subscription) * 100;

    return [
        'one_time' => $one_time_price,
        'monthly_total' => $total_subscription,
        'savings_amount' => $savings,
        'savings_percentage' => $percentage,
        'savings_formatted' => format_rupiah($savings),
        'is_cheaper' => $savings > 0,
        'break_even_months' => $monthly_price > 0 ? ceil($one_time_price / $monthly_price) : 0,
    ];
}

/**
 * Get pricing comparison table data
 */
function get_pricing_comparison($one_time_price, $monthly_price) {
    return [
        '1_bulan' => [
            'one_time' => $one_time_price,
            'subscription' => $monthly_price,
            'savings' => calculate_savings($one_time_price, $monthly_price, 1)
        ],
        '6_bulan' => [
            'one_time' => $one_time_price,
            'subscription' => $monthly_price * 6,
            'savings' => calculate_savings($one_time_price, $monthly_price, 6)
        ],
        '12_bulan' => [
            'one_time' => $one_time_price,
            'subscription' => $monthly_price * 12,
            'savings' => calculate_savings($one_time_price, $monthly_price, 12)
        ],
        '24_bulan' => [
            'one_time' => $one_time_price,
            'subscription' => $monthly_price * 24,
            'savings' => calculate_savings($one_time_price, $monthly_price, 24)
        ],
    ];
}

/**
 * Get recommended pricing option
 */
function recommend_pricing($one_time_price, $monthly_price, $usage_months = 12) {
    $total_subscription = $monthly_price * $usage_months;

    if ($total_subscription > $one_time_price) {
        return [
            'recommendation' => 'one_time',
            'reason' => 'Lebih hemat ' . format_rupiah($total_subscription - $one_time_price) . ' untuk penggunaan ' . $usage_months . ' bulan',
            'savings' => $total_subscription - $one_time_price,
        ];
    } else {
        return [
            'recommendation' => 'subscription',
            'reason' => 'Lebih fleksibel dengan biaya bulanan rendah, bisa berhenti kapan saja',
            'savings' => 0,
        ];
    }
}

/**
 * Calculate total order price
 */
function calculate_order_total($items, $pricing_model = 'one_time') {
    $subtotal = 0;
    $setup_fee = 0;

    foreach ($items as $item) {
        $quantity = $item['quantity'] ?? 1;

        if ($pricing_model === 'one_time') {
            $price = $item['one_time_price'] ?? 0;
            $subtotal += $price * $quantity;
        } else {
            $price = $item['monthly_price'] ?? 0;
            $subtotal += $price * $quantity;
            $setup_fee += ($item['setup_fee'] ?? 0) * $quantity;
        }
    }

    $total = $subtotal + $setup_fee;

    return [
        'subtotal' => $subtotal,
        'setup_fee' => $setup_fee,
        'total' => $total,
        'subtotal_formatted' => format_rupiah($subtotal),
        'setup_fee_formatted' => format_rupiah($setup_fee),
        'total_formatted' => format_rupiah($total),
    ];
}

/**
 * Calculate commission for freelancer
 */
function calculate_commission($order_total, $tier = 'tier_1') {
    $commission_rates = [
        'tier_1' => 30.00,
        'tier_2' => 40.00,
        'tier_3' => 50.00,
        'tier_max' => 55.00,
    ];

    $rate = $commission_rates[$tier] ?? 30.00;
    $commission_amount = ($order_total * $rate) / 100;

    return [
        'tier' => $tier,
        'rate' => $rate,
        'amount' => $commission_amount,
        'rate_formatted' => format_percentage($rate),
        'amount_formatted' => format_rupiah($commission_amount),
    ];
}

/**
 * Get freelancer tier based on completed orders
 */
function get_freelancer_tier($completed_orders) {
    if ($completed_orders >= 75) {
        return [
            'tier' => 'tier_max',
            'name' => 'Tier MAX',
            'commission_rate' => 55.00,
            'bonus_rate' => 5.00,
            'color' => 'diamond',
            'badge' => 'bi-gem',
        ];
    } elseif ($completed_orders >= 25) {
        return [
            'tier' => 'tier_3',
            'name' => 'Tier 3',
            'commission_rate' => 50.00,
            'bonus_rate' => 0.00,
            'color' => 'gold',
            'badge' => 'bi-trophy',
        ];
    } elseif ($completed_orders >= 10) {
        return [
            'tier' => 'tier_2',
            'name' => 'Tier 2',
            'commission_rate' => 40.00,
            'bonus_rate' => 0.00,
            'color' => 'silver',
            'badge' => 'bi-star',
        ];
    } else {
        return [
            'tier' => 'tier_1',
            'name' => 'Tier 1',
            'commission_rate' => 30.00,
            'bonus_rate' => 0.00,
            'color' => 'bronze',
            'badge' => 'bi-award',
        ];
    }
}

/**
 * Calculate next tier requirements
 */
function next_tier_requirements($current_orders) {
    if ($current_orders >= 75) {
        return [
            'current_tier' => 'Tier MAX',
            'next_tier' => null,
            'orders_needed' => 0,
            'message' => 'Anda sudah di tier tertinggi!',
        ];
    } elseif ($current_orders >= 25) {
        return [
            'current_tier' => 'Tier 3',
            'next_tier' => 'Tier MAX',
            'orders_needed' => 75 - $current_orders,
            'message' => 'Butuh ' . (75 - $current_orders) . ' orderan lagi untuk Tier MAX (komisi 55%)',
        ];
    } elseif ($current_orders >= 10) {
        return [
            'current_tier' => 'Tier 2',
            'next_tier' => 'Tier 3',
            'orders_needed' => 25 - $current_orders,
            'message' => 'Butuh ' . (25 - $current_orders) . ' orderan lagi untuk Tier 3 (komisi 50%)',
        ];
    } else {
        return [
            'current_tier' => 'Tier 1',
            'next_tier' => 'Tier 2',
            'orders_needed' => 10 - $current_orders,
            'message' => 'Butuh ' . (10 - $current_orders) . ' orderan lagi untuk Tier 2 (komisi 40%)',
        ];
    }
}

/**
 * Format pricing comparison row (for tables)
 */
function pricing_table_row($label, $one_time, $subscription, $highlight = false) {
    $class = $highlight ? 'table-primary' : '';

    return sprintf(
        '<tr class="%s">
            <td>%s</td>
            <td class="text-end">%s</td>
            <td class="text-end">%s</td>
        </tr>',
        $class,
        e($label),
        $one_time,
        $subscription
    );
}

/**
 * Get pricing features comparison
 */
function pricing_features_comparison() {
    return [
        'one_time' => [
            'label' => 'Beli Putus',
            'features' => [
                'Setup Fee' => 'Rp 350K - 1.5M+',
                'Monthly Fee' => 'Rp 0 (GRATIS!)',
                'Ownership' => 'PENUH (100%)',
                'Source Code' => 'Ya, diberikan',
                'Domain' => 'Anda yang punya',
                'Hosting' => 'Terserah Anda',
                'Maintenance' => 'Opsional',
                'Cocok untuk' => 'Bisnis jangka panjang',
            ],
        ],
        'subscription' => [
            'label' => 'Sewa Bulanan',
            'features' => [
                'Setup Fee' => 'Rp 0 (GRATIS!)',
                'Monthly Fee' => 'Rp 150K - 350K/bln',
                'Ownership' => 'Sewa (rental)',
                'Source Code' => 'Tidak',
                'Domain' => 'Bisa pakai milik Anda',
                'Hosting' => 'Include, unlimited',
                'Maintenance' => 'Include GRATIS',
                'Cocok untuk' => 'Testing, UMKM baru',
            ],
        ],
    ];
}

/**
 * Get pricing benefits (why choose each option)
 */
function pricing_benefits() {
    return [
        'one_time' => [
            'Ownership penuh 100%',
            'Source code diberikan',
            'Bebas hosting sendiri',
            'Lebih hemat jangka panjang',
            'No recurring fees',
            'Bisa dijual/transfer',
        ],
        'subscription' => [
            'Tanpa setup fee (Rp 0!)',
            'Bisa berhenti kapan saja',
            'Maintenance included',
            'Hosting included',
            'Update gratis selamanya',
            'Support 24/7',
        ],
    ];
}

/**
 * Calculate ROI (Return on Investment)
 */
function calculate_roi($initial_cost, $monthly_revenue, $months = 12) {
    $total_revenue = $monthly_revenue * $months;
    $profit = $total_revenue - $initial_cost;
    $roi_percentage = ($profit / $initial_cost) * 100;

    return [
        'initial_cost' => $initial_cost,
        'monthly_revenue' => $monthly_revenue,
        'total_revenue' => $total_revenue,
        'profit' => $profit,
        'roi_percentage' => $roi_percentage,
        'break_even_months' => $monthly_revenue > 0 ? ceil($initial_cost / $monthly_revenue) : 0,
        'profit_formatted' => format_rupiah($profit),
        'roi_formatted' => format_percentage($roi_percentage, 1),
    ];
}

/**
 * Get price range for category
 */
function get_price_range($services, $pricing_model = 'one_time') {
    if (empty($services)) {
        return [
            'min' => 0,
            'max' => 0,
            'avg' => 0,
            'range_text' => '-',
        ];
    }

    $prices = [];

    foreach ($services as $service) {
        if ($pricing_model === 'one_time') {
            $price = $service['one_time_price'] ?? 0;
        } else {
            $price = $service['monthly_price'] ?? 0;
        }

        if ($price > 0) {
            $prices[] = $price;
        }
    }

    if (empty($prices)) {
        return [
            'min' => 0,
            'max' => 0,
            'avg' => 0,
            'range_text' => '-',
        ];
    }

    $min = min($prices);
    $max = max($prices);
    $avg = array_sum($prices) / count($prices);

    return [
        'min' => $min,
        'max' => $max,
        'avg' => $avg,
        'range_text' => format_rupiah($min) . ' - ' . format_rupiah($max),
        'avg_formatted' => format_rupiah($avg),
    ];
}

/**
 * Check if service has discount
 */
function has_discount($service) {
    return isset($service['discount_percentage']) && $service['discount_percentage'] > 0;
}

/**
 * Calculate discounted price
 */
function calculate_discount($original_price, $discount_percentage) {
    $discount_amount = ($original_price * $discount_percentage) / 100;
    $final_price = $original_price - $discount_amount;

    return [
        'original' => $original_price,
        'discount_percentage' => $discount_percentage,
        'discount_amount' => $discount_amount,
        'final_price' => $final_price,
        'original_formatted' => format_rupiah($original_price),
        'discount_formatted' => format_rupiah($discount_amount),
        'final_formatted' => format_rupiah($final_price),
        'savings_formatted' => format_percentage($discount_percentage),
    ];
}
