<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Address
 *
 * @property int $id
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $number
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Address whereUpdatedAt($value)
 */
	class Address extends \Eloquent {}
}

namespace App{
/**
 * App\Donation
 *
 * @property int $id
 * @property int $donor_id
 * @property string $appointment_date
 * @property int|null $pulse
 * @property int|null $blood_pressure_systolic
 * @property int|null $blood_pressure_diastolic
 * @property int|null $consumed_fat
 * @property int|null $consumed_alcohol
 * @property int|null $has_smoked
 * @property int|null $sleep_quality
 * @property string $status
 * @property string $status_date
 * @property string|null $rejection_reason
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Donor $donor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereAppointmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereBloodPressureDiastolic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereBloodPressureSystolic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereConsumedAlcohol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereConsumedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereDonorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereHasSmoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation wherePulse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereSleepQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereStatusDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donation whereUpdatedAt($value)
 */
	class Donation extends \Eloquent {}
}

namespace App{
/**
 * App\Donor
 *
 * @property int $id
 * @property int $user_id
 * @property int $current_address_id
 * @property int $residence_address_id
 * @property string $blood_type
 * @property string $rh
 * @property int $is_allowed
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Donation[] $donations
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereBloodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereCurrentAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereIsAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereResidenceAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereRh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Donor whereUserId($value)
 */
	class Donor extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $role
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

