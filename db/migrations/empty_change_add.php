    public function change()
				{
        $table = $this->table('');
        if (!$table->hasColumn('')) {
            $table->addColumn('', 'text', ['after' => ''])
                ->update();
        }
	}
}
