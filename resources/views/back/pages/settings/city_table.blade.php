<table class="table bordered-table sm-table mb-0"  id="ville-table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom de la ville</th>
            <th scope="col">Statut</th>
            <th scope="col" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cities as $index => $city)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <div class="d-flex align-items-center gap-1">
                        <div class="flex-grow-1">
                            <span class="text-md mb-0 fw-normal text-secondary-light">{{ $city->name }}</span>
                        </div>
                    </div>
                </td>

                <td>
                    <a href="javascript:void(0)"
                       class=" badge bg-{{ $city->status ? 'success' : 'danger' }}">
                        {{ $city->status ? 'Active' : ' Inactive' }}
                    </a>
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)" onclick="openConfirmationModalcity('{{ route('city.updatestatus', $city) }}', {{ $city->status }}, '{{ $city->name }}')"
                        class="btn btn-{{ $city->status ? 'warning' : 'primary' }}-600 radius-8 px-14 py-6 text-sm">
                        {{ $city->status ? ' Désactiver ' : 'Activer' }}
                    </a>
                </td>
            </tr>





            </div>
        @endforeach

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#countrySelect').on('change', function() {
            var countryId = $(this).val();

            $.ajax({
                url: "{{ route('filter.cities') }}", // Assurez-vous que cela correspond à votre route
                type: 'GET',
                data: { country_id: countryId },
                success: function(response) {
                    $('#ville-table').html(response);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
    });
</script>
