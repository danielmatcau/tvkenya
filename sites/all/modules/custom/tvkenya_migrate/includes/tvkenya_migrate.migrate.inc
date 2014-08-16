<?php

abstract class TVKenyaMigration extends Migration {
  public $courses = NULL;
  public $events = NULL;
  public $accounts = NULL;

  public function __construct() {
    // Always call the parent constructor first for basic setup
    parent::__construct();

    $this->team = array(
      new MigrateTeamMember('Andrei Hainarosie', 'andrei.hainarosie@gmail.com', t('Implementor')),
      new MigrateTeamMember('Daniel Matcau', 'daniel.matcau@gmail.com', t('Implementor')),
    );

    // Default values
    $this->addFieldMapping('body')->defaultValue(NULL);
    $this->addFieldMapping('body:summary')->defaultValue(NULL);
    $this->addFieldMapping('body:format')->defaultValue(NULL);
    $this->addFieldMapping('body:language')->defaultValue(LANGUAGE_NONE);
    $this->addFieldMapping('created')->defaultValue(time());
    $this->addFieldMapping('changed')->defaultValue(time());
    $this->addFieldMapping('promote')->defaultValue(FALSE);
    $this->addFieldMapping('revision')->defaultValue(FALSE);
    $this->addFieldMapping('sticky')->defaultValue(FALSE);
    $this->addFieldMapping('status')->defaultValue(NODE_PUBLISHED);
    $this->addFieldMapping('uid')->defaultValue(1);
  }

  public function tvkenya_migrate_channel_columns() {
    // "Source": ('Fieldname', 'Description')
    $columns = array(
      0 => array('id', t('ID')),
      1 => array('name', t('Name')),
      2 => array('image', t('Image')),
    );

    return $columns;
  }

  public function tvkenya_migrate_show_columns() {
    $columns = array(
      // "Source": ('Fieldname', 'Description')
      0 => array('id', t('Id')),
      1 => array('channel', t('Channel')),
      2 => array('title', t('Title')),
      3 => array('description', t('Description')),
      4 => array('image', t('Image')),
      5 => array('start_date', t('Start Date')),
      6 => array('end_date', t('End Date')),
    );

    return $columns;
  }
}

/**
 * Migrate Channels.
 */
class TVKenyaChannelMigration extends TVKenyaMigration {
  private $subscriptions = NULL;

  public function __construct() {
    parent::__construct();
    $this->description = t('Import TV Kenya Channels');
    $this->map = new MigrateSQLMap($this->machineName,
      array(
        'id' => array(
          'type' => 'varchar',
          'length' => '255',
          'not null' => TRUE,
          'description' => 'Channel ID'
        )
      ),
      MigrateDestinationUser::getKeySchema()
    );

    $columns = $this->tvkenya_migrate_channel_columns();
    $this->source = new MigrateSourceCSV(DRUPAL_ROOT . '/' . drupal_get_path('module', 'tvkenya_migrate') . '/csv/channels.csv', $columns, array('header_rows' => 1));

    $this->destination = new MigrateDestinationNode('channel');

    // Mapped fields
    $this->addFieldMapping('title', 'name');
    $this->addFieldMapping('field_channel_image', 'image');
  }

  public function prepareRow($row) {
    // Check if channel exists.
    if (db_query('SELECT n.nid FROM {node} n WHERE n.type = :type AND n.title = :title',
          array(':type' => 'channel', 'title' => trim($row->name)))->fetchField()) {
      // Skip row.
      return FALSE;
    }
  }

//   public function prepare(stdClass $node, stdClass $row) {
//   }
}

/**
 * Import shows.
 */
class TVKenyaShowMigration extends TVKenyaMigration {
  public function __construct() {
    parent::__construct();
    $this->description = t('Import shows.');

    $this->map = new MigrateSQLMap($this->machineName,
      array(
        'id' => array(
          'type' => 'varchar',
          'length' => '255',
          'not null' => TRUE,
          'description' => 'Show ID'
        )
      ),
      MigrateDestinationNode::getKeySchema()
    );

    $columns = $this->tvkenya_migrate_show_columns();
    $this->source = new MigrateSourceCSV(DRUPAL_ROOT . '/' . drupal_get_path('module', 'tvkenya_migrate') . '/csv/shows.csv', $columns, array('header_rows' => 1, 'delimiter' => '#'));

    $this->destination = new MigrateDestinationNode('show');

    // Mapping fields
    $this->addFieldMapping('title', 'title');
    $this->addFieldMapping('body', 'description', FALSE);
    $this->addFieldMapping('field_show_image', 'image');
    $this->addFieldMapping('field_show_date', 'start_date');
    $this->addFieldMapping('field_show_date:to', 'end_date');
  }

  public function prepareRow($row) {
    $row->channel_id = db_query('SELECT n.nid FROM {node} n WHERE n.type = :type AND n.title = :title',
      array(
        ':type' => 'channel',
        ':title' => trim($row->channel)
      )
    )
    ->fetchField();
    if (!$row->channel_id) {
      watchdog('TVKenya Migrate - Show', 'Unable to import node on row :row.', array(':row' => $row->id));
      return FALSE;
    }
  }

  public function prepare(stdClass $node, stdClass $row) {
    $node->comment = COMMENT_NODE_OPEN;
    $node->facebook_comments_enabled = TRUE;
    $node->facebook_comments_amount = 10;
    $node->field_channel = array(
      LANGUAGE_NONE => array(
        0 => array(
          'target_id' => $row->channel_id
        )
      )
    );
  }
}
