<!DOCTYPE html>
<html>
<head>
    <title>Company</title>

</head>
<body>
    <h2>Company List</h2>
    <table>
        <thead>
            <tr>
                <th>Company</th>
                <th>Description</th>
                <th>Address</th>

            </tr>
        </thead>
        <tbody>
            @foreach($companies as  $company)
                <tr>


                    <td>{{ $company->name }}</td>
                    <td>{{ $company->description }}</td>
                    <td>{{ $company->address }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
