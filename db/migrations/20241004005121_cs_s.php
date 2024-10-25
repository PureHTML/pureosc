<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CsS extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
  public function change(): void {
        $table = $this->table('css');
        $table
            ->addColumn('name', 'string', ['limit' => 128])
            ->addColumn('value', 'text')
            ->addColumn('sort_order', 'integer')
            ->addColumn('min', 'integer')
            ->addColumn('max', 'integer')
            ->addColumn('template', 'string', ['limit' => 128])
            ->addColumn('subtemplate', 'string', ['limit' => 128])
            ->addColumn('tag', 'string', ['limit' => 128])
            ->addColumn('status', 'integer')
            ->addColumn('inline', 'integer')
            ->create();
    }
    
}
