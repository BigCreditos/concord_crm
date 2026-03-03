<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    @includeWhen(config('core.favicon_enabled'), 'favicon')

    @include('core::theme-change')

    <title>{{ config('app.name') }}</title>

    <script>
        window.Innoclapps = {
            bootingCallbacks: [],
            bootedCallbacks: [],
            booting: function(callback) {
                this.bootingCallbacks.push(callback)
            },
            booted: function(callback) {
                this.bootedCallbacks.push(callback)
            }
        }
        
        
        window.addEventListener("message", function (event) {
        if ((typeof event.data) == "string" && event.data.includes("appContext")) {
            var data = JSON.parse(event.data),
                lastRedirect = localStorage.getItem("lastRedirect");
            let urlCC = "https://chat.prosa.app.br/api/contacts/table?page=1&per_page=25&order[0][attribute]=created_at&order[0][direction]=desc&rules[condition]=and&q=" + data.data.contact.phone_number; 
            try {
                fetch(urlCC)
                .then(data => {
                    return data.json();
                })
                .then(con => {
                    if (con.hasOwnProperty('data') && con.data.length > 0 && lastRedirect != con.data[0].path) {
                        lastRedirect = localStorage.setItem("lastRedirect", con.data[0].path)
                        window.location.href = con.data[0].path
                    } else {
                        localStorage.removeItem("lastRedirect")
                    }
                })
            } catch (error) {
                console.log(urlCC, error);
            }
            
        }
    });

    window.parent.postMessage('chatwoot-dashboard-app:fetch-info', '*')
    
    </script>
    
    

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Adiciona todos os estilos personalizados registrados --}}
    @foreach (\Modules\Core\Facades\Innoclapps::styles() as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <link rel="stylesheet" href="{!! $path !!}">
        @else
            <link rel="stylesheet" href="{{ url("styles/$name") }}">
        @endif
    @endforeach

    @vite(['resources/js/app.js', 'resources/css/contentbuilder/theme.css'])

    {!! \Modules\Core\Facades\Innoclapps::viteOutput() !!}

    <script src="{{ \Modules\Core\Facades\Innoclapps::vueSrc() }}"></script>

    <script>
        updateTheme();

        var config = @json(\Modules\Core\Application::getDataProvidedToScript());
        var lang = @json(get_generated_lang(app()->getLocale()));
    </script>

    @includeIf('custom.includes.head')

    {{-- Head Flag --}}
    
    <style>
        .truncate {
            overflow: visible;
            text-overflow: unset;
            white-space: normal;
        }
    </style>

    
</head>


<body>
    <div class="flex h-screen overflow-hidden bg-neutral-100 dark:bg-neutral-800" id="app" v-cloak>
        <the-sidebar></the-sidebar>

        <div class="flex w-0 flex-1 flex-col overflow-hidden">

            @include('core::warnings.dashboard')

            <the-navbar></the-navbar>

            {{-- Navbar End Flag --}}

            @if ($alert = get_current_alert())
                <i-alert variant="{{ $alert['variant'] }}" dismissible>
                    <i-alert-body>
                        {{ $alert['message'] }}
                    </i-alert-body>
                </i-alert>
            @endif

            @if (auth()->user()->can('use voip') && config('voip.client') !== null)
                <call-component></call-component>
            @endif

            <router-view></router-view>

            <the-floating-resource-modal></the-floating-resource-modal>

            <teleport
                :to="confirmationDialog.value && confirmationDialog.value._teleport ? confirmationDialog.value._teleport :
                    'body'">
                <i-confirmation-dialog v-if="confirmationDialog.value" :dialog="confirmationDialog.value">
                </i-confirmation-dialog>
            </teleport>

            <teleport to="body">
                <the-float-notifications></the-float-notifications>
            </teleport>
        </div>
    </div>

    <script src="{{ asset('static/tinymce/tinymce.min.js?v=' . \Modules\Core\Application::VERSION) }}"></script>

    {{-- Add all of the custom registered scripts --}}
    @foreach (\Modules\Core\Facades\Innoclapps::scripts() as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <script src="{!! $path !!}"></script>
        @else
            <script src="{{ url("scripts/$name") }}"></script>
        @endif
    @endforeach

    @include('core::boot')

    <script>
        bootApplication(config, Innoclapps.bootingCallbacks, Innoclapps.bootedCallbacks);
    </script>
</body>

</html>
