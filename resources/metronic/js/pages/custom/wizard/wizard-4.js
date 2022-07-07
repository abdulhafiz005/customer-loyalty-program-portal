"use strict";

// Class definition
var KTWizard4 = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _validations = [];

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		_wizard = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		_wizard.on('beforeNext', function (wizard) {
			// Don't go to the next step yet
			_wizard.stop();

			// Validate form
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
			validator.validate().then(function (status) {
				if (status == 'Valid') {
					_wizard.goNext();
					KTUtil.scrollTop();
				} else {
					Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Change event
		_wizard.on('change', function (wizard) {
			KTUtil.scrollTop();
		});
	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					mId: {
						validators: {
							notEmpty: {
								message: 'Member ID is required',
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));



		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					"checkbox_select": {
						validators: {
							notEmpty: {
								message: 'Select Check Shell Product',
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					mb_id:{
						validators: {
							notEmpty: {
								message: 'Member ID is required',
							},
						},
					},
					tucker_name:{
						validators: {
							notEmpty: {
								message: 'Tucker Name is required',
							},
						},
					},
					converted_by:{
						validators: {
							notEmpty: {
								message: 'Select Converted By',
							},
						},
					},
					outlet_location:{
						validators: {
							notEmpty: {
								message: 'Select Outlet Location',
							},
						},
					},
					vehicle_name:{
						validators: {
							notEmpty: {
								message: 'Enter Vehicle Name',
							},
						},
					},
					vehicle_current_mileage:{
						validators: {
							notEmpty: {
								message: 'Enter Current Mileage',
							},
						},
					},
					next_oil_change:{
						validators: {
							notEmpty: {
								message: 'Enter Next Oil Chage Value',
							},
						},
					},
					customFile:{
						validators: {
							notEmpty: {
								message: 'Upload Evidence File',
							},
						},
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));
	}


	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_wizard_v4');
			_formEl = KTUtil.getById('kt_form');

			initWizard();
			initValidation();
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard4.init();
});
