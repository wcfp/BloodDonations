<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5/6/2018
 * Time: 6:23 PM
 */

namespace App;


interface DonationStatus
{
    const REQUESTED = "requested";
    const REGISTERED = "registered";
    const COLLECTED = "collected";
    const ANALYZED = "analyzed";
    const STORED = "stored";
    const REJECTED = "rejected";
}