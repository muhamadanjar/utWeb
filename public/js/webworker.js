importScripts('./ajax.js');
let timeReqLastPosition;
function reqLastPosition(address){
	ajax(address, null, 'GET', function(c) {
		self.postMessage({ cmd: 'resLastPosition', val: c.data });
		timeReqLastPosition = setTimeout(function() { reqLastPosition(address); }, 30000);
	});
}
self.addEventListener('message', function(a) {

	let b = a.data;
	let x = 1;
	switch (b.cmd) {
		case 'endLastPosition':
				clearTimeout(timeReqLastPosition);
		break;                
		case 'reqLastPosition':
				reqLastPosition(b.val);
		break;
		
		default:
				self.postMessage(1/x);
	}
}, false);