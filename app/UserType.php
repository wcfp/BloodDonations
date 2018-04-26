<?php
/**
 * Created by PhpStorm.
 * User: agavrila
 * Date: 2018-04-26
 * Time: 1:39 AM
 */

namespace App;


interface UserType
{
    const DONOR = 'DONOR';
    const DOCTOR = 'DOCTOR';
    const ADMIN = 'ADMIN';
    const ASSISTANT = 'ASSISTANT';
}