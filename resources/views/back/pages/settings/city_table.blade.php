<table class="table bordered-table sm-table mb-0"  id="ville-table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom de la ville</th>
            <th scope="col" class="text-center">Status</th>
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
                <td class="text-center">
                    <a href="javascript:void(0)" onclick="openConfirmationModalcity('{{ route('city.updatestatus', $city) }}', {{ $city->status }}, '{{ $city->name }}')"
                       class="bg-{{ $city->status ? 'success' : 'neutral' }}-focus text-{{ $city->status ? 'success' : 'neutral' }}-600 border border-{{ $city->status ? 'success' : 'neutral' }}-main px-24 py-4 radius-4 fw-medium text-sm">
                        {{ $city->status ? 'Activé' : 'Désactivé' }}
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
