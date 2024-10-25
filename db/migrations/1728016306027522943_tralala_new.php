<?php
declare(strict_types=1);
use Phinx\Migration\AbstractMigration;
final class TralalaNew extends AbstractMigration
  {
      public function change(): void
      {
        $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )
                                            values ('TralalaNew',            'TRALALA_NEW',             'true',              'TralalaNew',                   '1',               '9999',   NOW(),         NOW(),      NULL,         NULL)");
      }
  }