<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.9-dev
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

    /**
     * Default setup group
     */
    'default_setup' => 'default',

    /**
     * Default setup groups
     */
    'setups' => array(
        'default' => array(),
    ),

    /**
     * Default settings
     */
    'defaults' => array(

        /**
         * Mail useragent string
         */
        'useragent' => 'Fuel, a PHP Framework',

        /**
         * Mail driver (mail, smtp, sendmail, noop)
         */
        'driver' => 'smtp',

        /**
         * Whether to send as html, set to null for autodetection.
         */
        'is_html' => null,

        /**
         * Email charset
         */
        'charset' => 'utf-8',

        /**
         * Whether to encode subject and recipient names.
         * Requires the mbstring extension: http://www.php.net/manual/en/ref.mbstring.php
         */
        'encode_headers' => true,

        /**
         * Ecoding (8bit, base64 or quoted-printable)
         */
        'encoding' => '8bit',

        /**
         * Email priority
         */
        'priority' => \Email::P_NORMAL,

        /**
         * Default sender details
         */
        'from' => array(
            'email' => 'tranducluong8899999@gmail.com',
            'name'  => 'tranducluong',
        ),

        /**
         * If set to an email address, the email driver will replace all
         * email addresses in to, cc, bcc and reply-to with this address
         * This can be used for testing purposes, to make sure no actual
         * emails are send out by mistake.
         */
        'force_to' => null,

        /**
         * Whether to validate email addresses
         */
        'validate' => true,

        /**
         * Auto attach inline files
         */
        'auto_attach' => true,

        /**
         * Auto generate alt body from html body
         */
        'generate_alt' => true,

        /**
         * Forces content type multipart/related to be set as multipart/mixed.
         */
        'force_mixed' => false,

        /**
         * Wordwrap size, set to null, 0 or false to disable wordwrapping
         */
        'wordwrap' => 76,

        /**
         * Path to sendmail
         */
        'sendmail_path' => '/usr/sbin/sendmail -t -i',

        /**
         * SMTP settings
         */
        'smtp' => array(
            'host'     => 'sandbox.smtp.mailtrap.io',
            'port'     => 587,
            'username' => '40f1bd6313b46e',
            'password' => 'f8d1d9ff4f7257',
            'timeout'  => 5,
            'starttls' => true,
            'options'  => array(
            ),
        ),

        /**
         * Newline
         */
        'newline' => "\r\n",

        /**
         * Attachment paths
         */
        'attach_paths' => array(
            '', 		// absolute path
            DOCROOT, 	// relative to docroot.
        ),

        /**
         * Default return path
         */
        'return_path' => false,

        /**
         * Remove html comments
         */
        'remove_html_comments' => true,

        /**
         * Mandrill settings, see http://mandrill.com/
         */
        'mandrill' => array(
            'key' => 'api_key',
            'message_options' => array(),
            'send_options' => array(
                'async'   => false,
                'ip_pool' => null,
                'send_at' => null,
            ),
        ),

        /**
         * Mailgun settings, see http://www.mailgun.com/
         */
        'mailgun' => array(
            'key'    => 'api_key',
            'domain' => 'domain',
            'endpoint' => null // optional API URL; example: 'https://api.eu.mailgun.net/v3'; to use default, omit entirely or set to null
        ),

        /**
         * When relative protocol uri's ("//uri") are used in the email body,
         * you can specify here what you want them to be replaced with. Options
         * are "http://", "https://" or \Input::protocol() if you want to use
         * whatever was used to request the controller.
         */
        'relative_protocol_replacement' => false,
    ),
);
