@foreach($members as $member)
    <tr>
        <td>{{ $member->firstname }}</td>
        <td>{{ $member->lastname }}</td>
        <td><a href='#' class='btn btn-success edit' data-id='{{ $member->id }}' data-first='{{ $member->firstname }}' data-last='{{ $member->lastname }}'> Edit</a> 
            <a href='#' class='btn btn-danger delete' data-id='{{ $member->id }}'> Delete</a>
        </td>
    </tr>
@endforeach