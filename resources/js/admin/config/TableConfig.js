import users from "./tables/users";
import games from "./tables/games";
import gameCategories from "./tables/game-categories";
import pages from "./tables/pages";
import articles from "./tables/articles";
import articleCategories from "./tables/article-categories";
import pageCategories from "./tables/page-categories";
import languages from "./tables/languages";
import countries from "./tables/countries";
import userSubscriptions from "./tables/user-subscriptions";
import tags from "./tables/tags";
import properties from "./tables/properties";

const tableConfig = {
	users,
	userSubscriptions,
    games,
    pages,
    articles,
    gameCategories,
    articleCategories,
    pageCategories,
    languages,
    countries,
    tags,
    properties
};

export default tableConfig;
