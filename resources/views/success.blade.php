
    @if (session('message'))
            <div style="color:blue">
                <ul>
                    <li>{{ session('message') }}</li>
                </ul>
            </div>
    @endif
