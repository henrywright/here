<?php
/**
 * Here class
 *
 * @package Here
 * @subpackage Classes
 */

/**
 * The Here class definition.
 *
 * @since 1.0.0
 */
class Here {

	/**
	 * sha1 hash used as the transient key.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $hash;

	/**
	 * The transient value.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $value = 'here';

	/**
	 * The number of seconds until the transient expires.
	 *
	 * @since 1.0.0
	 * @var int
	 */
	public $expire_in = 900;

	/**
	 * Set properties.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $email The email of the user.
	 */
	public function __construct( $email ) {
		$this->hash = sha1( $email );
	}

	/**
	 * Set a transient.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool True if the value was set, else false.
	 */
	public function set() {
		return set_transient( $this->hash, $this->value, $this->expire_in );
	}

	/**
	 * Get a transient.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return mixed
	 */
	public function get() {
		return get_transient( $this->hash );
	}

	/**
	 * Delete a transient.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool True if successful, else false.
	 */
	public function delete() {
		return delete_transient( $this->hash );
	}
}
