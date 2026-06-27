@extends('layouts.app')

@section('content')
{{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    alert("dd")
    axios.post(
    'https://onelogin.doh.go.th:8080/api/authen',
    {
        code: "f222c4fe320923d0c1662b597194dfb5a88491574df70c8b0dc52b5718cd0fa8"
    },
    {
        withCredentials: true,
        headers: {
            'Content-Type': 'application/json'
        }
    }
)
.then(response => {

    console.log(response.data);

    const token = response.data.token;

    // เรียก API user ต่อ

})
.catch(error => {

    console.error(error.response);

});
</script> --}}
a
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    alert("d")
async function loginAndGetUser() {
    try {

        // 1. Login เพื่อรับ Token
        const authResponse = await axios.post(
            'https://onelogin.doh.go.th:8080/api/authen',
            {
                code: "f222c4fe320923d0c1662b597194dfb5a88491574df70c8b0dc52b5718cd0fa8"
            },
            {
                withCredentials: true,
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        );

        console.log("Auth Response:", authResponse.data);

        const token = authResponse.data.token;

        console.log("Token:", token);

        // 2. เรียกข้อมูลผู้ใช้
     const api = axios.create({
    headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json'
    }
});
delete api.defaults.headers.common['X-Requested-With'];
const userResponse = await api.get(
    'https://onelogin.doh.go.th:8080/api/user'
);

        console.log("User:", userResponse);
const user = userResponse.data.data[0];

await axios.post('/login/onelogin', {
    user: user
});

window.location.href = "/forms";
    } catch (error) {

        if (error.response) {
            console.log("Status:", error.response.status);
            console.log("Data:", error.response.data);
        } else {
            console.log(error.message);
        }

    }
}

loginAndGetUser();
</script>
@endsection
