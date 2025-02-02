document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({email,password}),
        });
    
        const data = await response.json();
        document.getElementById('response').innerText = JSON.stringify(data, null, 2);
    
        if (response.ok) {
            localStorage.setItem('token', data.token);
            alert('Login Successful')
    
            window.location.href = '/dashboard'
        }else{
            alert('Login Failed: ' + data.message)
        }
    } catch (error) {
        console.error('Error during login:', error);
        alert('An error occurred during login. Please try again.')
    }
});

async function logout() {
    const token = localStorage.getItem('token');

    try {
        const response = await fetch('http://127.0.0.1:8000/api/logout',{
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
            }
        });
    
        const data = await response.json();
        console.log(data);
    
        localStorage.removeItem('item');
    
        window.location.href = '/login';
    } catch (error) {
        console.error('Error during logout:', error);
        alert('An error occurred during logout. Please try again.');
    }
}