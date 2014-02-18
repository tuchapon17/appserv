/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: TH (Thai; ไทย)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "โปรดระบุข้อมูล",
		remote: "โปรดแก้ไขให้ถูกต้อง",
		email: "โปรดระบุที่อยู่อีเมล์ให้ถูกต้อง",
		url: "โปรดระบุ URL ที่ถูกต้อง",
		date: "โปรดระบุวันที่ ที่ถูกต้อง",
		dateISO: "โปรดระบุวันที่ ที่ถูกต้อง (ระบบ ISO).",
		number: "โปรดระบุทศนิยมที่ถูกต้อง",
		digits: "โปรดระบุเฉพาะตัวเลข",
		creditcard: "โปรดระบุรหัสบัตรเครดิตที่ถูกต้อง",
		equalTo: "โปรดระบุค่าเดิมอีกครั้ง",
		accept: "โปรดระบุค่าที่มีส่วนขยายที่ถูกต้อง",
		maxlength: $.validator.format("ข้อมูลยาวเกิน {0} อักษร"),
		minlength: $.validator.format("โปรดกรอกข้อมูลอย่างน้อย {0} อักษร"),
		rangelength: $.validator.format("โปรดกรอกข้อมูลที่มีความยาวระหว่าง {0} ถึง {1} อักษร"),
		range: $.validator.format("โปรดระบุค่าระหว่าง {0} และ {1}"),
		max: $.validator.format("โปรดระบุค่าน้อยกว่าหรือเท่ากับ {0}"),
		min: $.validator.format("โปรดระบุค่ามากกว่าหรือเท่ากับ {0}")
	});
}(jQuery));