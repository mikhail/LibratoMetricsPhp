Metrics for Librato
===================

This class provides a simple way to push metrics to Librato.
Their own example is at `their support website <http://support.metrics.librato.com/knowledgebase/articles/169077-how-to-get-data-into-librato-with-php>`_.

Example
-------

.. code-block:: php

    <?php
    require_once 'class.metrics.php';

    $metrics = new metrics();

    $metrics->track('members.online.count', $member_count);
    $metrics->track('staff.online.count', $staff_count);

    $metrics->send();
    ?>



