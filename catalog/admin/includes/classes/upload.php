<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class upload
{
    public $file;
    public $filename;
    public $destination;
    public $permissions;
    public $extensions;
    public $tmp_filename;
    public $message_location;

    public function __construct($file = '', $destination = '', $permissions = '777', $extensions = '')
    {
        $this->set_file($file);
        $this->set_destination($destination);
        $this->set_permissions($permissions);
        $this->set_extensions($extensions);

        $this->set_output_messages('direct');

        if (!empty($this->file) && !empty($this->destination)) {
            $this->set_output_messages('session');

            if (($this->parse() === true) && ($this->save() === true)) {
                return true;
            }

            return false;
        }
    }

    public function parse()
    {
        global $messageStack;

        $file = [];

        if (isset($_FILES[$this->file])) {
            $file = ['name' => $_FILES[$this->file]['name'],
                'type' => $_FILES[$this->file]['type'],
                'size' => $_FILES[$this->file]['size'],
                'tmp_name' => $_FILES[$this->file]['tmp_name']];
        }

        if (!empty($file['tmp_name']) && ($file['tmp_name'] !== 'none') && is_uploaded_file($file['tmp_name'])) {
            if (\count($this->extensions) > 0) {
                if (!\in_array(strtolower(substr($file['name'], strrpos($file['name'], '.') + 1)), $this->extensions, true)) {
                    if ($this->message_location === 'direct') {
                        $messageStack->add(ERROR_FILETYPE_NOT_ALLOWED, 'error');
                    } else {
                        $messageStack->add_session(ERROR_FILETYPE_NOT_ALLOWED, 'error');
                    }

                    return false;
                }
            }

            $this->set_file($file);
            $this->set_filename($file['name']);
            $this->set_tmp_filename($file['tmp_name']);

            return $this->check_destination();
        }

        if ($this->message_location === 'direct') {
            $messageStack->add(WARNING_NO_FILE_UPLOADED, 'warning');
        } else {
            $messageStack->add_session(WARNING_NO_FILE_UPLOADED, 'warning');
        }

        return false;
    }

    public function save()
    {
        global $messageStack;

        if (substr($this->destination, -1) !== '/') {
            $this->destination .= '/';
        }

        if (move_uploaded_file($this->file['tmp_name'], $this->destination.$this->filename)) {
            chmod($this->destination.$this->filename, $this->permissions);

            if ($this->message_location === 'direct') {
                $messageStack->add(SUCCESS_FILE_SAVED_SUCCESSFULLY, 'success');
            } else {
                $messageStack->add_session(SUCCESS_FILE_SAVED_SUCCESSFULLY, 'success');
            }

            return true;
        }

        if ($this->message_location === 'direct') {
            $messageStack->add(ERROR_FILE_NOT_SAVED, 'error');
        } else {
            $messageStack->add_session(ERROR_FILE_NOT_SAVED, 'error');
        }

        return false;
    }

    public function set_file($file): void
    {
        $this->file = $file;
    }

    public function set_destination($destination): void
    {
        $this->destination = $destination;
    }

    public function set_permissions($permissions): void
    {
        $this->permissions = octdec($permissions);
    }

    public function set_filename($filename): void
    {
        $this->filename = $filename;
    }

    public function set_tmp_filename($filename): void
    {
        $this->tmp_filename = $filename;
    }

    public function set_extensions($extensions): void
    {
        if (!empty($extensions)) {
            if (\is_array($extensions)) {
                $this->extensions = $extensions;
            } else {
                $this->extensions = [$extensions];
            }
        } else {
            $this->extensions = [];
        }
    }

    public function check_destination()
    {
        global $messageStack;

        if (!tep_is_writable($this->destination)) {
            if (is_dir($this->destination)) {
                if ($this->message_location === 'direct') {
                    $messageStack->add(sprintf(ERROR_DESTINATION_NOT_WRITEABLE, $this->destination), 'error');
                } else {
                    $messageStack->add_session(sprintf(ERROR_DESTINATION_NOT_WRITEABLE, $this->destination), 'error');
                }
            } else {
                if ($this->message_location === 'direct') {
                    $messageStack->add(sprintf(ERROR_DESTINATION_DOES_NOT_EXIST, $this->destination), 'error');
                } else {
                    $messageStack->add_session(sprintf(ERROR_DESTINATION_DOES_NOT_EXIST, $this->destination), 'error');
                }
            }

            return false;
        }

        return true;
    }

    public function set_output_messages($location): void
    {
        switch ($location) {
            case 'session':
                $this->message_location = 'session';

                break;
            case 'direct':
            default:
                $this->message_location = 'direct';

                break;
        }
    }
}
