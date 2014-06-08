$.validator.addMethod("decimal62", function(value, element){
	//เมื่อกรอกข้อมูลถึงจะตรวจสอบ
	if(value.length > 0)
		return this.optional(element) || /^([0-9]{1,6})(\.[0-9]{1,2})?$/.test(value);
	//ถ้าไม่มีข้อมูลให้ผ่าน สำหรับ field default = 0
	else return true;
}, "รูปแบบตัวเลขไม่ถูกต้อง.");
$.validator.addMethod("THEN", function(value, element){
	return this.optional(element) || /^[a-zA-Zก-ํ\/]+$/.test(value);
}, "กรอกได้เฉพาะอักษรไทย/อังกฤษ");
$.validator.addMethod("percentage", function(value, element){
	return this.optional(element) || /^(100(\.0{1,2})?|[1-9]?\d(\.\d{1,2})?)$/.test(value);
}, "รูปแบบร้อยละไม่ถูกต้อง");
