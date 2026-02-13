<?php
/**
 * Payment Calculator for precise financial calculations.
 *
 * @package WPTravelEngine\Utilities
 * @subpackage MoneyMath
 * @since 6.7.0
 */
declare(strict_types=1);

namespace WPTravelEngine\Utilities;

use InvalidArgumentException;
use WPTravelEngine\Traits\Factory;

/**
 * PaymentCalculator class for handling precise monetary calculations.
 * Uses BCMath extension for arbitrary precision arithmetic.
 */
final class PaymentCalculator {

	use Factory;

	/**
	 * Number of decimal places for each currency.
	 *
	 * @var array<string, int>
	 */
	private const SCALE = array(
		'USD' => 2,
	);

	/**
	 * Number of decimal places for calculations.
	 *
	 * @var int
	 */
	private int $scale;

	/**
	 * Has bcmath extension.
	 *
	 * @var bool
	 */
	private bool $has_bcmath;

	/**
	 * Constructor.
	 *
	 * @param string   $currency Currency code.
	 * @param int|null $scale Number of decimal places.
	 *
	 * @since 6.7.1 Added $scale parameter.
	 */
	public function __construct( string $currency = 'USD', $scale = null ) {
		$this->scale      = $scale ?? self::SCALE[ $currency ] ?? 2;
		$this->has_bcmath = extension_loaded( 'bcmath' );

		if ( $this->has_bcmath ) {
			bcscale( $this->scale );
		}
	}

	/**
	 * Add two numbers.
	 *
	 * @param string $a First number.
	 * @param string $b Second number.
	 * @return string Result of addition.
	 */
	public function add( string $a, string $b ): string {
		if ( $this->has_bcmath ) {
			return bcadd( $a, $b, $this->scale );
		}
		return number_format( floatval( $a ) + floatval( $b ), $this->scale, '.', '' );
	}

	/**
	 * Subtract second number from first.
	 *
	 * @param string $a First number.
	 * @param string $b Second number (to subtract).
	 * @return string Result of subtraction.
	 */
	public function subtract( string $a, string $b ): string {
		if ( $this->has_bcmath ) {
			return bcsub( $a, $b, $this->scale );
		}
		return number_format( floatval( $a ) - floatval( $b ), $this->scale, '.', '' );
	}

	/**
	 * Multiply two numbers.
	 *
	 * @param string $a First number.
	 * @param string $b Second number.
	 * @return string Result of multiplication.
	 */
	public function multiply( string $a, string $b ): string {
		if ( $this->has_bcmath ) {
			return bcmul( $a, $b, $this->scale );
		}
		return number_format( floatval( $a ) * floatval( $b ), $this->scale, '.', '' );
	}

	/**
	 * Divide first number by second.
	 *
	 * @param string $a Dividend.
	 * @param string $b Divisor.
	 * @return string Result of division.
	 * @throws InvalidArgumentException If divisor is zero.
	 */
	public function divide( string $a, string $b ): string {
		if ( $this->has_bcmath ) {
			if ( bccomp( $b, '0', $this->scale ) === 0 ) {
				throw new InvalidArgumentException( 'Division by zero is not allowed' );
			}
			return bcdiv( $a, $b, $this->scale );
		}
		if ( floatval( $b ) === 0 ) {
			throw new InvalidArgumentException( 'Division by zero is not allowed' );
		}
		return number_format( floatval( $a ) / floatval( $b ), $this->scale, '.', '' );
	}

	/**
	 * Calculate tax amount.
	 *
	 * @param string $amount Base amount.
	 * @param string $taxRate Tax rate (e.g., '0.13' for 13%).
	 * @return string Calculated tax amount.
	 */
	public function calculate_tax( string $amount, string $taxRate ): string {
		if ( $this->has_bcmath ) {
			return bcmul( $amount, $taxRate, $this->scale );
		}
		return $this->multiply( $amount, $taxRate );
	}

	/**
	 * Calculate total with tax and discount.
	 *
	 * @param string $subtotal Subtotal amount.
	 * @param string $tax Tax amount.
	 * @param string $discount Discount amount (default: '0.00').
	 * @return string Final total.
	 */
	public function calculate_total( string $subtotal, string $tax, string $discount = '0.00' ): string {
		$afterDiscount = $this->subtract( $subtotal, $discount );
		return $this->add( $afterDiscount, $tax );
	}

	/**
	 * Compare two numbers.
	 *
	 * @param string $a First number.
	 * @param string $b Second number.
	 * @return int Returns 0 if equal, 1 if $a > $b, -1 if $a < $b.
	 */
	public function compare( string $a, string $b ): int {
		if ( $this->has_bcmath ) {
			return bccomp( $a, $b, $this->scale );
		}
		$a_rounded = round( floatval( $a ), $this->scale );
		$b_rounded = round( floatval( $b ), $this->scale );
		return $a_rounded <=> $b_rounded;
	}

	/**
	 * Get the current scale.
	 *
	 * @return int Current scale value.
	 */
	public function get_scale(): int {
		return $this->scale;
	}

	/**
	 * Normalize the value to the scale.
	 *
	 * @param string $value Value to normalize.
	 *
	 * @return string Normalized value.
	 */
	public function normalize( string $value ): string {
		if ( $this->has_bcmath ) {
			return bcadd( $value, '0', $this->scale );
		}
		return number_format( floatval( $value ), $this->scale, '.', '' );
	}
}
