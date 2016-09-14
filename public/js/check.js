$(document).ready(function() {
    var nameFlag = true;    //׼��һ���û����Ŀ����Ա�ʶ
    $('#username').keyup(function() {    //�û�����һ���ַ��ʹ�����Ӧ
        var length = $(this).val().length; 
        if ( length >= 2 && length <= 20 ) {    //�ж��û������� 2��20λ֮��
            //�����û�������������Ϊ name
            $.post('##', {username: $(this).val(),type:'name'}, function(data, textStatus, xhr) {
                if (textStatus == 'success') {
                    if (data == '1') {    //�����̨����1�����ʾ���û����ѱ�ע��
                        $('#dis_un').text('UserName is already registered');    //����������ʾ
                        nameFlag = false;
                    }else{    //�û�������ʹ��
                        $('#dis_un').text('');    //ȥ��������ʾ����
                        nameFlag = true;
                    }
                }
            });
        }else{    //���Ȳ������򲻽��м��
            $('#dis_un').text('');
        }
    });
});
var emailFlag = true;    //׼��һ������Ŀ����Ա�ʶ
$('#remail').blur(function() {    //ע������ʧȥ����ż��
        if ($(this).val() != '') {    //���벻Ϊ�վͼ��
            var reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;    //������ʽ�ж������ʽ
            if (reg.test($(this).val())) {    //�������ʽ
                $.post('##', {email: $(this).val(),type: 'email'}, function(data, textStatus, xhr) {
                    if (textStatus == 'success') {
                        if (data == '1') {    //��̨����1 ��ʾ�ѱ�ע��
                            $('#dis_em').text('E-mail is already registered');
                            emailFlag = false;
                        }else{    //�������
                            $('#dis_em').text('');
                            emailFlag = true;
                        }
                    }
                });
            }else{    //���������ʽ
                $('#dis_em').text('E-mail format is incorrect');
                emailFlag = false;
            }
        }else{    //Ϊ�գ�����ʾ��ʾ����
            $('#dis_em').text('');
        }
    });
	var pwdFlag = true;   //׼��һ������Ŀ����Ա�ʶ    
$('#password').blur(function(){    //������
        if ($(this).val() == '') {
            $('#dis_pwd').text('Password cannot be empty');
        }else if($(this).val().length < 6){
            $('#dis_pwd').text('Passwords must be at least six');
        }else{
            $('#dis_pwd').text('');
        }
    });

    $('#confirm').blur(function() {    //ȷ��������
        var val = $('#password').val();
        if (val != '') {
            if ($(this).val() == '') {
                $('#dis_con_pwd').text('Please confirm your password');
                pwdFlag = false;
            }else if($(this).val() != val){
                $('#dis_con_pwd').text('Confirm password inconsistent');
                pwdFlag = false;
            }else{
                $('#dis_con_pwd').text('');
                pwdFlag = true;
            }
        }else{
            $('#dis_con_pwd').text('');
            pwdFlag = false;
        }
    });
	$('#reg').click(function() {
        if (!(nameFlag && emailFlag && pwdFlag)) {    //�û�����ʶ && �����ʶ && �����ʶ
            alert('Please check page info!');
            return false;
        }
    });
	//�û���Ψһ�Լ��
$.post('admin/Register.php', {username: $(this).val(),type:'name'}, function(data, textStatus, xhr) {
  *****
}
//����Ψһ�Լ��
$.post('admin/Rregister.php', {email: $(this).val(),type: 'email'}, function(data, textStatus, xhr) {
  *****
};