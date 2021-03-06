# Release Notes for v2.x

This changelog references the relevant changes (bug and security fixes) done to `laravie/authen`.

## 2.6.0

Released: 2021-04-15

### Changes

* Clean-up dependencies requirement and multiple trivia changes.

## 2.5.0

Released: 2020-08-29

### Changes

* Update minimum PHP to 7.2+.
* Add support for Laravel Framework v8.0.
* Drop support for Laravel Framework v5.8.

## 2.4.0

Released: 2019-08-26

### Changes

* Update minimum PHP to 7.2+.
* Add support for Laravel Framework v6.0.

## 2.3.1

Released: 2019-07-21

### Changes

* Use `static function` rather than `function` whenever possible, the PHP engine does not need to instantiate and later GC a `$this` variable for said closure.

## 2.3.0

Released: 2019-04-08

### Changes

* Remove support for Laravel Framework v5.7 and below.

## 2.2.1

Released: 2019-02-21

### Changes

* Improve performance by prefixing all global functions calls with `\` to skip the look up and resolve process and go straight to the global function.

## 2.2.0

Released: 2019-02-13

### Changes

* Use `password_verify()` directly when verifying password hash and fallback to `Illuminate\Contracts\Hashing\Hasher::check()`.

## 2.1.1

Released: 2018-09-13

### Changes

* Trivia update library setup.

## 2.1.0

Released: 2018-04-30

### Changes

* Remove support for Laravel Framework v5.5.
* Update minimum PHP to 7.1+.

## 2.0.0

Released: 2017-11-13

### Changes

* Remove support for Laravel Framework v5.3 and v5.4.
* Update minimum PHP to 7.0+.
