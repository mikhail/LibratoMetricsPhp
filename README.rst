Metrics for Librato
===================

This class provides a simple way to push metrics to Librato.

Example
-------

.. code-block:: php

    <?php
    require_once 'class.metrics.php';

    $metrics = new metrics();

    $metrics->track('members.online.count', $member_count);
    $metrics->track('staff.online.count', $staff_count);

    $metrics->send();


