<ul class="accordion mb-0px">
    <li id="published-section">
            <div class="title">
                                        <span>
                                            Published
                                            @if(count($published) > 0)
                                                (<span class="numbers">{{ count($published) }}</span>)
                                            @endif
                                        </span>
            </div>
        <div class="content">
            @if(count($published) > 0)
                    @foreach($published as $article)
                        <div class="article-prev mb8">
                            <h5 class="mb8">{{ $article->title }}</h5>
                            <div class="article-prev-img left">
                                <img class="article-list-img" src="{{ $article->image ? url()->to('/').'/blog/500x500/'.$article->image->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                            </div>
                            <div class="article-prev-content right">
                                <p class="pt0">{{ \App\Helpers\Helpers::getExcerpt(200, strip_tags($article->content)) }}</p>
                                <p class="opacity07">Published: {{ $article->published_at ? $article->published_at : 'NO'}}</p>
                                <p class="article-prev-buttons">
                                    <a class="preview-blog" href="{{ action('FrontendController@blogEntry', ['url' => $article->url]) }}">View</a>
                                    <a class="edit-blog ml20 color-blue-prof" href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                                </p>
                            </div>
                            <div class="clearboth"></div>
                        </div>
                    @endforeach
            @else
                <p>You have no published blog entries yet.</p>
            @endif
        </div>
    </li>

    <li id="submitted-section">
            <div class="title">
                                        <span>
                                            Submitted
                                            @if(count($submitted)  > 0)
                                                (<span class="numbers">{{ count($submitted) }}</span>)
                                            @endif
                                        </span>
            </div>
        <div class="content">
            @if(count($submitted) > 0)
                    @foreach($submitted as $article)

                    <div class="article-prev mb8">
                        <h5 class="mb8">{{ $article->title }}</h5>
                        <div class="article-prev-img left">
                            <img class="article-list-img" src="{{ $article->image ? url()->to('/').'/blog/500x500/'.$article->image->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                        </div>
                        <div class="article-prev-content right">
                            <p class="pt0">{{ \App\Helpers\Helpers::getExcerpt(200, strip_tags($article->content)) }}</p>
                            <p class="opacity07">Created: {{ $article->created_at }}<br>Reviewed? {{ $article->reviewed ? 'YES' : 'NO'}}</p>
                            <p class="article-prev-buttons">
                                <a class="preview-blog" href="{{ action('FrontendController@previewArticle', ['id' => $article->id]) }}">Preview</a>
                                <a class="edit-blog ml20 color-blue-prof" href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                            </p>
                        </div>
                        <div class="clearboth"></div>
                    </div>
                    @endforeach
            @else
                <p>You have no submitted blog entries.</p>
            @endif
        </div>
    </li>

    <li id="drafts-section">
            <div class="title">
                                        <span>
                                            Drafts
                                            @if(count($drafts)  > 0)
                                                (<span class="numbers">{{ count($drafts) }}</span>)
                                            @endif
                                        </span>
            </div>
        <div class="content">
            @if(count($drafts) > 0)
                    @foreach($drafts as $article)
                    <div class="article-prev mb8">
                        <h5 class="mb8">{{ $article->title }}</h5>
                        <div class="article-prev-img left">
                            <img class="article-list-img" src="{{ $article->image ? url()->to('/').'/blog/500x500/'.$article->image->filename : url()->to('/').'/images/avatars/no_image.png' }}">
                        </div>
                        <div class="article-prev-content right">
                            <p class="pt0">{{ \App\Helpers\Helpers::getExcerpt(200, strip_tags($article->content)) }}</p>
                            <p class="opacity07">Created: {{ $article->created_at }}<br>Comments? {{ $article->disable_comments ? 'NO' : 'YES'}}</p>
                            <p class="article-prev-buttons">
                                <a class="preview-blog" href="{{ action('FrontendController@previewArticle', ['id' => $article->id]) }}">Preview</a>
                                <a class="edit-blog ml20 color-blue-prof" href="{{ action('FrontendController@editArticle', ['id' => $article->id]) }}">Edit</a>
                            </p>
                        </div>
                        <div class="clearboth"></div>
                    </div>
                    @endforeach
                </table>
            @else
                <p>You have no blog entries drafts.</p>
            @endif
        </div>
    </li>
</ul>