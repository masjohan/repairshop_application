RW.Join = function() {
	$(this.setup.bind(this));
}

RW.Join.prototype.setup = function() {
	this.jForm = $('#form-join'); 
	this.FV = (new RW.FormVal(this.jForm))
		.addRule('email',{
			required : 1,
			pattern: RW.FormVal.GetPattern('email'),
			message: "We just need your email address.",
			jsonCb : this.sendStepOne
		})
		.helpPopover();
	
	this.FV.evtPassed.subscribe(this.afterStepOne.bind(this),'RW.Join');
}

RW.Join.prototype.sendStepOne = function(elEmail){
	RW.Waiting();
	return {
		get:"/json/join",
		data:{
			step: 'sendcode',
			email:elEmail.value
		},
		helperCb: function(R){
			RW.Waiting.close(); 
			return R;
		}
	};
}

RW.Join.prototype.afterStepOne = function() {
	
	this.jForm.find('.step2').show();
	
	this.jForm.find(':input[name=email]').attr('readonly','1');
	this.FV
		.removeRule('email')
		.addRule('code',{
			required : 1,
			message: "we just need to make sure you are using that email.",
			jsonCb : this.sendStepTwo
		})
		.initialize();

	this.FV.evtPassed.subscribe(this.afterStepTwo.bind(this), 'RW.Join');
}

RW.Join.prototype.sendStepTwo = function(elCode){
	RW.Waiting();
	return {
		get:"/json/join",
		data:{
			step: 'checkcode',
			code: elCode.value
		},
		helperCb: function(R){
			RW.Waiting.close(); 
			return R;
		}
	};
}

RW.Join.prototype.afterStepTwo = function() {
	RW.Waiting.close();
	this.jForm.find('.step3').show();
	this.jForm.find(':input[name=code]').attr('readonly','1');
	
	this.FV
		.removeRule('code')
		.addRule('pw1',{
			required : 1,
			pattern: /\w{6,}/,
			message: "at least 6 letters or digits"
		})
		.addRule('pw2',{
			required : 1,
			message: "make sure your typing",
			helperCb: function(elPw2){
				if(this.jForm.find(':input[name=pw1]').val() !== elPw2.value) {
					return {
						error: 1,
						message: 're-typed password don\'t match'
					};
				}
			}.bind(this),
			jsonCb : this.sendStepThree
		})
		.initialize();

	this.FV.evtPassed.subscribe(this.afterStepThree.bind(this), 'RW.Join');
}

RW.Join.prototype.sendStepThree = function(elPw2){
	RW.Waiting();
	return {
		get:"/json/join",
		data:{
			step: 'setpwd',
			passwd: elPw2.value
		},
		helperCb: function(R){
			RW.Waiting.close(); 
			return R;
		}
	};
}

RW.Join.prototype.afterStepThree = function() {
	location.assign('/');
}

new RW.Join();