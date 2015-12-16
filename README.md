opencart_module
===============

An Opencart module for the InPost Shipping method.

Installation
============

The Opencart module requires vQmod to be installed **before** you try and install the InPost shipping module.

The place to get the vQmod files is :-

	https://code.google.com/p/vqmod/

There is a video showing the whole installation process in the below web page.

	https://code.google.com/p/vqmod/wiki/Install_OpenCart

It shows all of the steps from downloading the vQmod files to checking that the mod is working.

## Security

The module includes a new sales module for the modifying of Parcel data. You **must** allow permisions for this using the

	Users > User Groups > Permisions.

## Store Settings

To allow the InPost shipping to calculate the correct dimensions for the parcels you **must** have the store length measurement set to cm. The actual products can be measured in any of the other units.

## Versions

1.5 16th December 2015

* I have applied various fixes to the code.

1 The filtering options on the InPost Parcel list screen now work.
1 The editing of the InPost parcel can only be done if the parcel is in the correct status.
1 The Size of parcel in the edit parcel form is now a select.
1 The length of the mobile phone field is restricted to the correct length.
1 The length of the parcel machine is extended to fourteen characters.
1 The Parcel status select on the list of parcels is now a select.
1 The Edit parcel option on the Parcel list form is removed for parcels of the wrong status.
1 When a parcel has it's label printed it status is changed and it can no longer be edited.
1 A check is made to prevent the editing of a parcel with the wrong status.
1 It is now possible to use HTTPS for the cURL calls.

