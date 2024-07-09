<footer style="background: black; height: 100px">
    <div class="container d-flex align-items-center justify-content-between h-100">

        <div>
            <ul class="nav navbar-nav navbar-right-loginpage lineheight d-flex flex-row" >
                <li>
                    <a href="https://colorofchange.org/"class="px-2">
                        <img class="rounded" src="{{ asset('/images/color-of-change.png')  }}" width="50">
                    </a>
                </li>
                <li>
                    <a href="https://www.higherheightsforamerica.org/"class="px-2" >
                        <img class="rounded" src="{{ asset('/images/higher-heights.jpg')  }}" width="50">
                    </a>
                </li>
                <li>
                    <a href="http://vote.org/" class="px-2">
                        <img class="rounded" src="{{ asset('/images/vote-org.png')  }}" width="50">
                    </a>
                </li>
                <li>
                    <a href="https://www.ballotpedia.org/Main_Page" class="px-2">
                        <img class="rounded" src="{{ asset('/images/ballotpedia.png')  }}" width="50">
                    </a>
                </li>
                <li>
                    <a href="https://www.reach.vote/" class="px-2">
                        <img class="rounded" src="{{ asset('/images/reach-vote.png')  }}" width="50">
                    </a>
                </li>
                <li>
                    <a href="https://www.fairfight.org/" class="px-2">
                        <img class="rounded" src="{{ asset('/images/fairfight.png')  }}" width="50">
                    </a>
                </li>
            </ul>
        </div>

       <div class="text-center" style="color: #bebebe;">
            <strong>Copyright © {{ date('Y') }}
            <a href="{{ urL('/') }}" class="text-light">
                New Athens Creative (NAC)
            </a>
        </strong>
        <br>
            All rights reserved.
        </div>
    </div>
 </footer>
