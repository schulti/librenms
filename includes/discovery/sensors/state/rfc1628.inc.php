<?php

echo 'RFC1628 ';

// Battery Status (Value : 1 unknown, 2 batteryNormal, 3 batteryLow, 4 batteryDepleted)
$state = snmp_get($device, "upsBatteryStatus.0", "-Ovqe", 'UPS-MIB');
if (is_numeric($state)) {
    //Create State Index
    $state_name = 'upsBatteryStatusState';
    create_state_index(
        $state_name,
        array(
            array('value' => 1, 'generic' => 3, 'graph' => 0, 'descr' => 'Unknown'),
            array('value' => 2, 'generic' => 0, 'graph' => 0, 'descr' => 'Normal'),
            array('value' => 3, 'generic' => 2, 'graph' => 0, 'descr' => 'Low'),
            array('value' => 4, 'generic' => 2, 'graph' => 0, 'descr' => 'Depleted'),
        )
    );

    discover_sensor(
        $valid['sensor'],
        'state',
        $device,
        '.1.3.6.1.2.1.33.1.2.1.0',
        0,
        $state_name,
        'Battery Status',
        1,
        1,
        null,
        null,
        null,
        null,
        $state,
        'snmp',
        0
    );

    //Create Sensor To State Index
    create_sensor_to_state_index($device, $state_name, $index);
}

// Output Source (Value : 1 other, 2 none, 3 normal, 4 bypass, 5 battery, 6 booster, 7 reducer)
$state = snmp_get($device, "upsOutputSource.0", "-Ovqe", 'UPS-MIB');
if (is_numeric($state)) {
    //Create State Index
    $state_name = 'upsOutputSourceState';
    create_state_index(
        $state_name,
        array(
            array('value' => 1, 'generic' => 3, 'graph' => 0, 'descr' => 'Other'),
            array('value' => 2, 'generic' => 3, 'graph' => 0, 'descr' => 'None'),
            array('value' => 3, 'generic' => 0, 'graph' => 0, 'descr' => 'Normal'),
            array('value' => 4, 'generic' => 2, 'graph' => 0, 'descr' => 'Bypass'),
            array('value' => 5, 'generic' => 2, 'graph' => 0, 'descr' => 'Battery'),
            array('value' => 6, 'generic' => 2, 'graph' => 0, 'descr' => 'Booster'),
            array('value' => 7, 'generic' => 2, 'graph' => 0, 'descr' => 'Reducer'),
        )
    );

    discover_sensor(
        $valid['sensor'],
        'state',
        $device,
        '.1.3.6.1.2.1.33.1.4.1.0',
        0,
        $state_name,
        'Output Source',
        1,
        1,
        null,
        null,
        null,
        null,
        $state,
        'snmp',
        0
    );

    //Create Sensor To State Index
    create_sensor_to_state_index($device, $state_name, $index);
}
