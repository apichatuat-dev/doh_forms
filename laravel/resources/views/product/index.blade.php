@extends('layouts.app')

@section('content')
<script>
    alert("dd")
    axios.post(
    'https://onelogin.doh.go.th/api/authen',
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
</script>
@endsection
