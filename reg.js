
function validate(form)
{
   re = /[0-9]/;
      if(!re.test(form.password.value)) {
        alert("fgh");
        form.password.focus();
        return false;

      }
      re = /[a-z]/;
      if(!re.test(form.password.value)) {
        alert("abc");
        form.password.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.password.value)) {
        alert("def");
        form.password.focus();
        return false;
      }
      else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.password.focus();
      return false;
    }
      return true;
}
