<?php
declare(strict_types=1);
use Phinx\Migration\AbstractMigration;
final class STORE_LOGO_TXT extends AbstractMigration
  {
      public function change(): void
      {
        $this->execute("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function )
                                            values ('STORE_LOGO_TXT',            'S_T_O_R_E__L_O_G_O__T_X_T',             '< PureOSC >',              'STORE_LOGO_TXT',                   '1',               '9999',   NOW(),         NOW(),      NULL,         NULL)");
      }
  }
