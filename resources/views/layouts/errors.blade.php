 @if ($errors->{ $bag ?? 'default' }->any())
        <div class="field mt-6">
            <ul class="field mt-6 list-reset">
                @foreach ($errors->{ $bag ?? 'default' }->all() as $error)
                    <li class="text-sm text-red-800">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
 @endif