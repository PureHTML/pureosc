<?php
  declare(strict_types=1);
  use Phinx\Migration\AbstractMigration;

  final class EncryptionType extends AbstractMigration
  {
      public function change(): void
      {

 $row = $this->fetchRow("SELECT configuration_id FROM configuration WHERE configuration_key='ENCRYPTION_TYPE'");
  if (!$row) {
  $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )
                         values ('EncryptionType',            'ENCRYPTION_TYPE',             'otp',              'EncryptionType',                   '1',               '9999',   NOW(),         NOW(),      NULL,         NULL)");
      }
    }
  }
