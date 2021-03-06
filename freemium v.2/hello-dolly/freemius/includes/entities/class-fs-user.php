<?php
	/**
	 * @package     Freemius
	 * @copyright   Copyright (c) 2015, Freemius, Inc.
	 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	 * @since       1.0.3
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	class FS_User extends FS_Scope_Entity {
		public $email;
		public $first;
		public $last;
		public $is_verified;

		/**
		 * @param stdClass|bool $user
		 */
		function __construct( $user = false ) {
			if ( ! ( $user instanceof stdClass ) ) {
				return;
			}

			parent::__construct( $user );

			$this->email       = $user->email;
			$this->first       = $user->first;
			$this->last        = $user->last;
			$this->is_verified = $user->is_verified;
		}

		function get_name()
		{
			return trim(ucfirst(trim(is_string($this->first) ? $this->first : '')) . ' ' . ucfirst(trim(is_string($this->last) ? $this->last : '')));
		}

		function is_verified()
		{
			return (isset($this->is_verified) && true === $this->is_verified);
		}

		static function get_type()
		{
			return 'user';
		}
	}