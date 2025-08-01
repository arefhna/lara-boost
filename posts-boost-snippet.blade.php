@if (!$post->is_boosted)
    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#boostModal{{ $post->id }}">
        Elanı İrəli Çək
    </a>
@endif

<div class="modal fade" id="boostModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="boostModalLabel{{ $post->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ route('boost.post') }}">
      @csrf
      <input type="hidden" name="post_id" value="{{ $post->id }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Elanı İrəli Çək</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Bu paket 24 saatlıq aktivlik dövründə hər 8 saatdan bir elanı irəli çəkəcək.</p>
          <p><strong>Qiymət: 1.99 AZN</strong></p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Aktiv Et</button>
        </div>
      </div>
    </form>
  </div>
</div>
